#include <stdlib.h>
#include <stdio.h>
#include <errno.h>
#include <string.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/wait.h>
#include <sys/stat.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <signal.h>
#include <ctype.h>          
#include <arpa/inet.h>
#include <netdb.h>
#include <dirent.h>
#include <time.h>
#include <regex.h>
#include <openssl/md5.h>
#include <sys/mman.h>
#include <fcntl.h>

#define PORT 20000 
#define BACKLOG 5
#define LENGTH 512
#define SHARED "/home/manhattan/Serious Stuff/Computer Networks/Shared Folder/"

void error(const char *msg)
{
	perror(msg);
	exit(1);
}

void send_receive_command();
void send_file(char *fs_name);
void receive_file(char *fr_name);
void send_latest_files();
void send_all_files();
void send_regex_files(char *regex_expr);
void filehash_verify(char *filename);
void filehash_checkall();
void file_download();
void file_upload();


/* Defining Variables */
int sockfd;
int nsockfd;
int num;
int sin_size;
struct sockaddr_in addr_local; /* client addr */
struct sockaddr_in addr_remote; /* server addr */
char revbuf[LENGTH]; // Receiver buffer


int main ()
{

	/* Get the Socket file descriptor */
	if((sockfd = socket(AF_INET, SOCK_STREAM, 0)) == -1 )
	{
		fprintf(stderr, "ERROR: Failed to obtain Socket Descriptor. (errno = %d)\n", errno);
		exit(1);
	}
	else 
		printf("[Server] Obtaining socket descriptor successfully.\n");

	/* Fill the client socket address struct */
	addr_local.sin_family = AF_INET; // Protocol Family
	addr_local.sin_port = htons(PORT); // Port number
	addr_local.sin_addr.s_addr = INADDR_ANY; // AutoFill local address
	bzero(&(addr_local.sin_zero), 8); // Flush the rest of struct

	/* Bind a special Port */
	if( bind(sockfd, (struct sockaddr*)&addr_local, sizeof(struct sockaddr)) == -1 )
	{
		fprintf(stderr, "ERROR: Failed to bind Port. (errno = %d)\n", errno);
		exit(1);
	}
	else 
		printf("[Server] Binded tcp port %d in addr 127.0.0.1 sucessfully.\n",PORT);

	/* Listen remote connect/calling */
	if(listen(sockfd,BACKLOG) == -1)
	{
		fprintf(stderr, "ERROR: Failed to listen Port. (errno = %d)\n", errno);
		exit(1);
	}
	else
		printf ("[Server] Listening the port %d successfully.\n", PORT);


    sin_size = sizeof(struct sockaddr_in);

    /* Wait a connection, and obtain a new socket file despriptor for single connection */
    if ((nsockfd = accept(sockfd, (struct sockaddr *)&addr_remote, &sin_size)) == -1)
    {
        fprintf(stderr, "ERROR: Obtaining new Socket Despcritor. (errno = %d)\n", errno);
        exit(1);
    }
    else
        printf("[Server] Server has got connected from %s.\n", inet_ntoa(addr_remote.sin_addr));

    send_receive_command();

//    char* fr_name = "/home/manhattan/Serious Stuff/Computer Networks/receive";
//    receive_file(fr_name);

//    char* fs_name = "/home/manhattan/Serious Stuff/Computer Networks/output";
//    send_file(fs_name);


    close(nsockfd);
    printf("[Server] Connection with Client closed. Server will wait now...\n");
//    while(waitpid(-1, NULL, WNOHANG) > 0);
    return 0;
}

void send_receive_command()
{
    int n;
    char buffer[1024];
    bzero(buffer,256);
    n = read(nsockfd,buffer,255);

    if (n < 0)
        error("ERROR reading from socket");

    printf("Here is the message: %s\n",buffer);
    printf("Length of buffer = %d\n", (int)strlen(buffer));

    if (strstr(buffer,"IndexGet") != NULL)
    {
        if (strstr(buffer, "ShortList") != NULL)
        {
            send_latest_files();
        }
        else if (strstr(buffer, "LongList") != NULL)
        {
            send_all_files();
        }
        else if (strstr(buffer, "RegEx") != NULL)
        {
            char *pch;
            char buffer_backup[1024];
            strcpy(buffer_backup, buffer);
            pch = strtok (buffer_backup, " ");
            int i=2;
            while(i--)
                pch = strtok(NULL, " ");
            send_regex_files(pch);
        }
    }
    else if (strstr(buffer, "FileHash") != NULL)
    {
        if (strstr(buffer, "Verify") != NULL)
        {
            char *pch;
            char buffer_backup[1024];
            strcpy(buffer_backup, buffer);
            pch = strtok (buffer_backup, " ");
            int i=2;
            while(i--)
                pch = strtok(NULL, " ");
            filehash_verify(pch);
        }
        else if (strstr(buffer, "CheckAll") != NULL)
        {
            filehash_checkall();
        }
    }
    else if (strstr(buffer, "FileDownload") != NULL)
    {
        file_download();
    }
    else if (strstr(buffer, "FileUpload") != NULL)
    {
        file_upload();
    }
}

void send_file(char* fs_name)
{
    /* Send File to Client */
//    char* fs_name = "/home/manhattan/Serious Stuff/Computer Networks/output";
    char sdbuf[LENGTH]; // Send buffer
    printf("[Server] Sending %s to the Client...", fs_name);
    FILE *fs = fopen(fs_name, "r");
    if(fs == NULL)
    {
        fprintf(stderr, "ERROR: File %s not found on server. (errno = %d)\n", fs_name, errno);
        exit(1);
    }
    bzero(sdbuf, LENGTH);
    int fs_block_sz;
    while((fs_block_sz = fread(sdbuf, sizeof(char), LENGTH, fs))>0)
    {
        if(send(nsockfd, sdbuf, fs_block_sz, 0) < 0)
        {
            fprintf(stderr, "ERROR: Failed to send file %s. (errno = %d)\n", fs_name, errno);
            exit(1);
        }
        bzero(sdbuf, LENGTH);
    }
    printf("Ok sent to client!\n");
}

void receive_file(char* fr_name)
{
    /*Receive File from Client */
//    char* fr_name = "/home/manhattan/Serious Stuff/Computer Networks/receive";
    FILE *fr = fopen(fr_name, "a");
    if(fr == NULL)
        printf("File %s Cannot be opened file on server.\n", fr_name);
    else
    {
        bzero(revbuf, LENGTH);
        int fr_block_sz = 0;
        while((fr_block_sz = recv(nsockfd, revbuf, LENGTH, 0)) > 0)
        {
            int write_sz = fwrite(revbuf, sizeof(char), fr_block_sz, fr);
            if(write_sz < fr_block_sz)
            {
                error("File write failed on server.\n");
            }
            bzero(revbuf, LENGTH);
            if (fr_block_sz == 0 || fr_block_sz != 512)
            {
                break;
            }
        }
        if(fr_block_sz < 0)
        {
            if (errno == EAGAIN)
            {
                printf("recv() timed out.\n");
            }
            else
            {
                fprintf(stderr, "recv() failed due to errno = %d\n", errno);
                exit(1);
            }
        }
        printf("Ok received from client!\n");
        fclose(fr);
    }
}


void send_latest_files()
{
    write(nsockfd, "\n---LIST START---", strlen("\n---LIST START---"));
    int n;
    struct stat buf;
    DIR *dp;
    struct dirent *ep;

    dp = opendir(SHARED);

    if (dp != NULL)
    {
        while(ep = readdir(dp))
        {
//            printf("%s\n", ep->d_name);
//            time_t t = time(NULL);
            char full_path[1024], date[100];
            strcpy(full_path, SHARED);
            strcat(full_path, ep->d_name);
            stat(full_path, &buf);
            strftime(date, 20, "%Y-%m-%d %H:%M:%S", localtime(&(buf.st_mtime)));
            printf("The file %s was last modified at %s\n", ep->d_name, date);
            n = write(nsockfd, ep->d_name, strlen(ep->d_name));
            if (n < 0)
                error("ERROR writing to socket");
        }
        closedir(dp);
    }
    else
    {
        perror("Couldn't open the directory\n");
        exit(1);
    }
    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
}

void send_all_files()
{
    write(nsockfd, "\n---LIST START---", strlen("\n---LIST START---"));
    int n;
    struct stat buf;
    DIR *dp;
    struct dirent *ep;

    dp = opendir(SHARED);

    if (dp != NULL)
    {
        while(ep = readdir(dp))
        {
//            printf("%s\n", ep->d_name);

            char full_path[1024], permissions[1024], trash[1024],date[100];
            strcpy(full_path, SHARED);
            strcat(full_path, ep->d_name);
            stat(full_path, &buf);
            strcpy(permissions, (S_ISDIR(buf.st_mode)) ? "d" : "-");
            strcat(permissions, (buf.st_mode & S_IRUSR) ? "r" : "-");
            strcat(permissions, (buf.st_mode & S_IWUSR) ? "w" : "-");
            strcat(permissions, (buf.st_mode & S_IXUSR) ? "x" : "-");
            strcat(permissions, (buf.st_mode & S_IRGRP) ? "r" : "-");
            strcat(permissions, (buf.st_mode & S_IWGRP) ? "w" : "-");
            strcat(permissions, (buf.st_mode & S_IXGRP) ? "x" : "-");
            strcat(permissions, (buf.st_mode & S_IROTH) ? "r" : "-");
            strcat(permissions, (buf.st_mode & S_IWOTH) ? "w" : "-");
            strcat(permissions, (buf.st_mode & S_IXOTH) ? "x" : "-");
            strcat(permissions, " ");
            sprintf(trash, "%8d", buf.st_size);
            strcat(permissions, trash);
            strcat(permissions, " ");
            strftime(date, 20, "%Y-%m-%d %H:%M", localtime(&(buf.st_mtime)));
            strcat(permissions, date);
            strcat(permissions, " ");
            strcat(permissions, ep->d_name);
            n = write(nsockfd, permissions, strlen(permissions));
            if (n < 0)
                error("ERROR writing to socket");
        }
        closedir(dp);
    }
    else
    {
        perror("Couldn't open the directory\n");
        exit(1);
    }
    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
}

void send_regex_files(char *regex_expr)
{
    write(nsockfd, "\n---LIST START---", strlen("\n---LIST START---"));
    regex_expr++;
    regex_expr[strlen(regex_expr)-2] = 0;
    printf("The RegEx is = %s\n", regex_expr);
    int n;
    struct stat buf;
    DIR *dp;
    struct dirent *ep;

    dp = opendir(SHARED);

    if (dp != NULL)
    {
        while(ep = readdir(dp))
        {
//            printf("%s\n", ep->d_name);

            regex_t regex;
            int reti;
            reti = regcomp(&regex, regex_expr, 0);
            if (reti)
                printf("The regex couldn't be compiled\n");
            reti = regexec(&regex, ep->d_name, 0, NULL, 0);
            printf("For %s, reti = %d\n", ep->d_name, reti);
            if( !reti )
            {
                char full_path[1024], permissions[1024], trash[1024],date[100];
                strcpy(full_path, SHARED);
                strcat(full_path, ep->d_name);
                stat(full_path, &buf);
                strcpy(permissions, (S_ISDIR(buf.st_mode)) ? "d" : "-");
                strcat(permissions, (buf.st_mode & S_IRUSR) ? "r" : "-");
                strcat(permissions, (buf.st_mode & S_IWUSR) ? "w" : "-");
                strcat(permissions, (buf.st_mode & S_IXUSR) ? "x" : "-");
                strcat(permissions, (buf.st_mode & S_IRGRP) ? "r" : "-");
                strcat(permissions, (buf.st_mode & S_IWGRP) ? "w" : "-");
                strcat(permissions, (buf.st_mode & S_IXGRP) ? "x" : "-");
                strcat(permissions, (buf.st_mode & S_IROTH) ? "r" : "-");
                strcat(permissions, (buf.st_mode & S_IWOTH) ? "w" : "-");
                strcat(permissions, (buf.st_mode & S_IXOTH) ? "x" : "-");
                strcat(permissions, " ");
                sprintf(trash, "%8d", buf.st_size);
                strcat(permissions, trash);
                strcat(permissions, " ");
                strftime(date, 20, "%Y-%m-%d %H:%M", localtime(&(buf.st_mtim)));
                strcat(permissions, date);
                strcat(permissions, " ");
                strcat(permissions, ep->d_name);
                n = write(nsockfd, permissions, strlen(permissions));
                if (n < 0)
                    error("ERROR writing to socket");
            }
        }
        closedir(dp);
    }
    else
    {
        perror("Couldn't open the directory\n");
        exit(1);
    }
    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
}

void filehash_verify(char *filename)
{
    write(nsockfd, "\n---LIST START---", strlen("\n---LIST START---"));
    filename[strlen(filename)-1] = 0;
//    printf("Filename = %s last character = %c\n", filename, filename[strlen(filename)-1]);
    char temp_path[100];
    strcpy(temp_path, SHARED);
    strcat(temp_path, filename);
    int file_descript;
    file_descript = open(temp_path, O_RDONLY);
    printf("file descriptor = %d\n", file_descript);
    if(file_descript < 0)
    {
        char *error_str = "ERROR: Could not open the file\n";
//        write(nsockfd, error_str, strlen(error_str));
        write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
        return;
    }
//    write(nsockfd, "\n---DETAILS START---", strlen("\n---DETAILS START---"));

    unsigned char result[MD5_DIGEST_LENGTH];
    struct stat buf;
    stat(temp_path, &buf);
    char *file_buffer;
    file_buffer = mmap(0, buf.st_size, PROT_READ, MAP_SHARED, file_descript, 0);
    MD5((unsigned char*) file_buffer, buf.st_size, result);

    int i;
    char md5_ans[1024], temp[100];
//    strcpy(md5_ans, "-");
    for(i=0; i <MD5_DIGEST_LENGTH; i++)
    {
        sprintf(temp, "%02x", result[i]);
        strcat(md5_ans, temp);
        printf("%02x\t%s\n", result[i], md5_ans);
    }

//    md5_ans++;
    printf("String = %s\n", md5_ans);
    char ans[1024], date[100];
    strcpy(ans, filename);
    strcat(ans, " ");
    strcat(ans, md5_ans);
    strcat(ans, " ");
    strftime(date, 20, "%Y-%m-%d %H:%M", localtime(&(buf.st_mtim)));
    strcat(ans, date);
    strcat(ans, "\n");
    write(nsockfd, ans, strlen(ans));
    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
}

void filehash_checkall()
{
    write(nsockfd, "\n---LIST START---", strlen("\n---LIST START---"));
    int n;
    DIR *dp;
    struct dirent *ep;

    dp = opendir(SHARED);

    if (dp != NULL)
    {
        while(ep = readdir(dp))
        {
            if (strcmp(ep->d_name, ".") && strcmp(ep->d_name, ".."))
            {
                char temp_path[1000];
                strcpy(temp_path, SHARED);
                strcat(temp_path, ep->d_name);
                int file_descript;
                file_descript = open(temp_path, O_RDONLY);
                if(file_descript < 0)
                {
                    //                char *error_str = "ERROR: Could not open the file\n";
                    //        write(nsockfd, error_str, strlen(error_str));
                    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
                    return;
                }

                unsigned char result[MD5_DIGEST_LENGTH];
                struct stat buf;
                stat(temp_path, &buf);
                char *file_buffer;
                file_buffer = mmap(0, buf.st_size, PROT_READ, MAP_SHARED, file_descript, 0);
                MD5((unsigned char*) file_buffer, buf.st_size, result);

                int i;
                char md5_ans[1024], temp[100];
                bzero(md5_ans, 1024);
                for(i=0; i <MD5_DIGEST_LENGTH; i++)
                {
                    sprintf(temp, "%02x", result[i]);
                    strcat(md5_ans, temp);
                    printf("%02x\t%s\n", result[i], md5_ans);
                }

                char ans[1024], date[100];
                strcpy(ans, ep->d_name);
                strcat(ans, " ");
                strcat(ans, md5_ans);
                strcat(ans, " ");
                strftime(date, 20, "%Y-%m-%d %H:%M", localtime(&(buf.st_mtim)));
                strcat(ans, date);
                write(nsockfd, ans, strlen(ans));
                if (n < 0)
                    error("ERROR writing to socket");
            }
        }
        closedir(dp);
    }
    else
    {
        perror("Couldn't open the directory\n");
        exit(1);
    }
    write(nsockfd, "---LIST END---\n", strlen("---LIST END---\n"));
}

void file_download()
{}

void file_upload()
{}
