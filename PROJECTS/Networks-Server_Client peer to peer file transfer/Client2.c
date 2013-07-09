/* A simple server in the internet domain using TCP
   The port number is passed as an argument */

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h> 
#include <sys/socket.h>
#include <netinet/in.h>
#include <dirent.h>
#include <sys/stat.h>
#include <sys/types.h>

void error(const char *msg)
{
    perror(msg);
    exit(1);
}

int main(int argc, char *argv[])
{
    int sockfd, newsockfd, portno;
    socklen_t clilen;
    char buffer[256];
    struct sockaddr_in serv_addr, cli_addr;
    int n;

    if (argc < 2) {
        fprintf(stderr,"ERROR, no port provided\n");
        exit(1);
    }

    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if (sockfd < 0)
        error("ERROR opening socket");

    bzero((char *) &serv_addr, sizeof(serv_addr));
    portno = atoi(argv[1]);
    serv_addr.sin_family = AF_INET;
    serv_addr.sin_addr.s_addr = INADDR_ANY;
    serv_addr.sin_port = htons(portno);

    if (bind(sockfd, (struct sockaddr *) &serv_addr,
             sizeof(serv_addr)) < 0)
        error("ERROR on binding");

    listen(sockfd,5);
    clilen = sizeof(cli_addr);
    newsockfd = accept(sockfd,
                       (struct sockaddr *) &cli_addr,
                       &clilen);

    if (newsockfd < 0)
        error("ERROR on accept");

    bzero(buffer,256);
    n = read(newsockfd,buffer,255);

    if (n < 0)
        error("ERROR reading from socket");

    printf("Here is the message: %s\n",buffer);
    printf("Length of buffer = %d\n", (int)strlen(buffer));
    buffer[(int)strlen(buffer)-1] = '\0';

    char cwd[1024];
    getcwd(cwd, sizeof(cwd));
    printf("Current working directory is %s\n", cwd);

//    status = stat(argv[1], &buff);
//    if (status != -1) {
//       if (S_ISDIR(buff.st_mode)) {
//         DIR *dp = opendir(argv[1]);
//         struct dirent *ep;
//         char* path = argv[1];
//         printf("Path = %s\n", path);

//         if (dp != NULL) {
//           while (ep = readdir(dp)) {
//           char* fullpath = strcat(path, ep->d_name);
//           printf("Full Path = %s\n", fullpath);
//         }
//         (void) closedir(dp);
//       } else {
//          perror("Couldn't open the directory");
//       }
//     }

//      } else {
//       perror(argv[1]);
//       exit(1);
//      }


    DIR *dp;
    struct dirent *ep;

    dp = opendir(buffer);

    if (dp != NULL)
    {
        while(ep = readdir(dp))
        {
            printf("%s\n", ep->d_name);
            strcat(ep->d_name, "\n");

//            stat(ep->d_name, &buf);
//            int size = buf.st_size;
//            printf("%d",size);

            n = write(newsockfd, ep->d_name, strlen(ep->d_name));
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

    close(newsockfd);
    close(sockfd);

    return 0;
}
