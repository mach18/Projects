#include <stdlib.h>
#include <stdio.h>
#include <errno.h>
#include <string.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <sys/wait.h>
#include <sys/socket.h>
#include <signal.h>
#include <ctype.h>          
#include <arpa/inet.h>
#include <netdb.h>

int PORT;
#define LENGTH 512 


void error(const char *msg)
{
	perror(msg);
	exit(1);
}


void send_receive_command();
void send_file(char* fs_name);
void receive_file(char *fr_name);

/* Variable Definition */
int sockfd;
int nsockfd;
char revbuf[LENGTH];
struct sockaddr_in remote_addr;


int main(int argc, char *argv[])
{

	/* Get the Socket file descriptor */
	PORT=atoi(argv[2]);
	if ((sockfd = socket(AF_INET, SOCK_STREAM, 0)) == -1)
	{
		fprintf(stderr, "ERROR: Failed to obtain Socket Descriptor! (errno = %d)\n",errno);
		exit(1);
	}

	/* Fill the socket address struct */
	remote_addr.sin_family = AF_INET; 
	remote_addr.sin_port = htons(PORT); 
	inet_pton(AF_INET,argv[1], &remote_addr.sin_addr); 
	bzero(&(remote_addr.sin_zero), 8);

	/* Try to connect the remote */
	if (connect(sockfd, (struct sockaddr *)&remote_addr, sizeof(struct sockaddr)) == -1)
	{
		fprintf(stderr, "ERROR: Failed to connect to the host! (errno = %d)\n",errno);
		exit(1);
	}
	else 
		printf("[Client] Connected to server at port %d...ok!\n", PORT);

//	while(1)
	{
 //   send_receive_command();

   char* fs_name = "/home/mahavir/sem4/Networks/Assignment/a.mp3";
   send_file(fs_name);

//    char* fr_name = "/home/mahavir/onlyfiles/naya.txt";
 //   receive_file(fr_name);


//    close (sockfd);
//    printf("[Client] Connection lost.\n");
	}
	return (0);
}

void send_receive_command()
{
    int n;
    char r_w_buffer[1024];
    int file_flag=0;
    printf("Please enter the message: ");
    bzero(r_w_buffer,256);
    fgets(r_w_buffer,255,stdin);
    n = write(sockfd, r_w_buffer, strlen(r_w_buffer));

    if (n < 0)
        error("ERROR writing to socket");

    bzero(r_w_buffer, 1024);
    while(1)
    {
        bzero(r_w_buffer, 1024);
        n = read(sockfd, r_w_buffer, 1024);
        if (n < 0)
            error("ERROR reading from socket");

	if(strcmp(r_w_buffer,"Hi\n") ==0)
	{	
		file_flag=1;
		continue;
	}
	if(strcmp(r_w_buffer,"Done\n")==0)
	{
		file_flag=0;
		printf("here\n");
		continue;
	}
	if(file_flag==0)
	{
		printf("%s ", r_w_buffer);
	}
	else
	{	
		FILE *fptr;
		fptr=fopen("NewDownloaded_file","a");
		fprintf(fptr,"%s\n", r_w_buffer);
		fclose(fptr);
	}
        if (strstr(r_w_buffer, "---LIST END---\n") != NULL)
            break;
    }
}
void send_file(char* fs_name)
{
    /* Send File to Server */
//    char* fs_name = "/home/manhattan/Serious Stuff/Computer Networks/Server-Client/check";
    char sdbuf[LENGTH];
    printf("[Client] Sending %s to the Server... ", fs_name);
    FILE *fs = fopen(fs_name, "r");
    if(fs == NULL)
    {
        printf("ERROR: File %s not found.\n", fs_name);
        exit(1);
    }

    bzero(sdbuf, LENGTH);
    int fs_block_sz;
    while((fs_block_sz = fread(sdbuf, sizeof(char), LENGTH, fs)) > 0)
    {
        if(send(sockfd, sdbuf, fs_block_sz, 0) < 0)
        {
            fprintf(stderr, "ERROR: Failed to send file %s. (errno = %d)\n", fs_name, errno);
            break;
        }
        bzero(sdbuf, LENGTH);
    }
    printf("Ok File %s from Client was Sent!\n", fs_name);
}

void receive_file(char* fr_name)
{
    /* Receive File from Server */
    printf("[Client] Receiving file from Server and saving it as final.txt...");
//    char* fr_name = "/home/manhattan/Serious Stuff/Computer Networks/server_check";
    FILE *fr = fopen(fr_name, "a");
    if(fr == NULL)
        printf("File %s Cannot be opened.\n", fr_name);
    else
    {
        bzero(revbuf, LENGTH);
        int fr_block_sz = 0;
        while((fr_block_sz = recv(sockfd, revbuf, LENGTH, 0)) > 0)
        {
            int write_sz = fwrite(revbuf, sizeof(char), fr_block_sz, fr);
            if(write_sz < fr_block_sz)
            {
                error("File write failed.\n");
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
            }
        }
        printf("Ok received from server!\n");
        fclose(fr);
    }
}
