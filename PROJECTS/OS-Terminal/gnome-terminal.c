#include<stdio.h>
#include<sys/types.h>
#include<stdlib.h>
#include<string.h>
#include<unistd.h>
#include<signal.h>
#include<wait.h>
#include <fcntl.h>
int flaged=0;
int pipecount=0;
char array[100][100];
int pipes[100];
int counter=0;							//counts argument in input command
int a,and=0;							//and checks if(bg==1)and=1 for fg and=0
int ef=0;
char history[100][20];						//history keep s all first arguments
int pidcount[100];						//contains all pids
int histcount=0;						//global counter for all process
int something=0;						// not of use
int current[100]={0};						//=1for current process
char completehistory[100][100];					// whole command is stored
char *substring(char* path,int a)				//moves ptr of path to path +a
{
	int i;
	for(i=a-1;i<strlen(path);i++)
		path[i-a]=path[i];
	path[i-a]='\0';
	return path;
}
void printpromt()						//prints promt
{
	char hostname[1024];
	char path[100];
	getcwd(path,100);
	gethostname(hostname,1023);
	if(strlen(path)>=a)
	{
		strcpy(path,substring(path,a));
		printf("<%s@%s:~%s>",getenv("USER"),hostname,path);
	}
	else
	{
		printf("<%s@%s:%s>",getenv("USER"),hostname,path);
	}
}
void sig_handler(int signum)					//Just a empty function
{
	return;
}
void child_handler(int signum)				//child_handler is the default handler for SIG_CHLD
{
	int pid;
	pid = waitpid(WAIT_ANY, NULL, WNOHANG);
	if(signum==SIGCHLD)
	{
		int temp=histcount;
		while(temp--)
			if(pidcount[temp]==pid)
				break;
		current[temp]=0;
		printf("\n%s %d Exited Normally\n",history[temp],pid);
		printpromt();
		fflush(stdout);
		something=1;
	}
	return;
}
int fd,fd1,parse_count=0;
char unparsedcommand[100];
int in_flag=0,out_flag=0;
void inputfile(char *strin)
{
	in_flag=1;
	FILE *test=fopen(strin, "r");
	fd=fileno(test);
}
void outputfile(char *strout)
{
	out_flag=1;
	FILE *test1=fopen(strout,"w");
	fd1=fileno(test1);
}
void func_out(char *line)
{
	char string_out[100];
	parse_count=0;
	while(*line!='\0')
	{
		if(*line!=' ')
			string_out[parse_count++]=*line;
		line++;	
	}
	string_out[parse_count++]='\0';
	outputfile(string_out);
}
void func_in(char *line)
{
	char string_in[100];
	parse_count=0;
	while(*line!='>' && *line!='\0')
	{
		if(*line!=' ')
			string_in[parse_count++]=*line;
		line++;
	}
	string_in[parse_count++]='\0';
	inputfile(string_in);
	if(*line!='\0')
	{	
		line++;
		func_out(line);
	}
}
void func_command(char *line)
{
	parse_count=0;
	while(*line!='<' && *line!='>')
		unparsedcommand[parse_count++]=*line++;
	if(*line=='<')
	{
		line++;
		func_in(line);
	}
	else
	{
		line++;
		func_out(line);
	}
}
void  redirection_parse(char *line, char **argv)                            //parse the input and return the first ptr..
{

	while (*line!='\0')
	{
		while ((*line == ' ' || *line == '\t' || *line == '\n'))
		{
			*line++ = '\0';
		}
		if(*line!='\0')
			*argv++ = line;
		while(*line != '\0' && *line !=' ' && *line != '\t' && *line != '\n')
		{	
			if(*line=='\'')
			{
				line++;
				while(*line!='\'')
				{
					*(line-1)=*line;
					line++;
				}
				line++;
				*(line-2)='\0';
				*(line-1)='\0';
				continue;
			}
			if(*line=='\"')
			{
				line++;
				while(*line!='\"')
				{
					*(line-1)=*line;
					line++;
				}
				line++;
				*(line-2)='\0';
				*(line-1)='\0';
				continue;
			}
			line++;
		}
	}
	*argv = '\0';
	return;

}
void redirection(char *line)
{
	int pid,status;
	fd=0,fd1=1;
	in_flag=0,out_flag=0;
	func_command(line);
	char *cmd[100];
	redirection_parse(unparsedcommand,cmd);
	pid=fork();
	if (pid==0) 
	{
		if(in_flag==1)
		{	
			dup2(fd,0);
			close(fd);
			in_flag=0;
		}
		if(out_flag==1)
		{
			out_flag=0;
			dup2(fd1,1);
			close(fd1);
		}
		if(hist_func(cmd)==1)
		{
			exit(1);
			return;
		}
		if(histn_func(cmd)==1)
		{
			exit(1);
			return;
		}
		if(pid_func(cmd)==1)
		{
			exit(1);
			return;
		}
		int b=execvp(*cmd,cmd);
		if(b<0)
		{
			perror("exec failed\n");
			exit(1);
		}
	}
	else
	{
		signal(SIGCHLD,sig_handler);
		wait(&status);
		signal(SIGCHLD,child_handler);
	}
	int i;
	for(i=0;i<100;i++)
		unparsedcommand[i]='\0';
}
void  pipeparse(char *line, char **argv)			//parse the input and return the first ptr..
{
	while (*line!='\0')
	{
		while ((*line == ' ' || *line == '\t' || *line == '\n'))
		{
			*line++ = '\0'; 
		}
		if(*line!='\0')
			*argv++ = line;
		while(*line != '\0' && *line !=' ' && *line != '\t' && *line != '\n') 
		{
			if(*line=='\'')
			{
				line++;
				while(*line!='\'')
				{
					*(line-1)=*line;
					line++;
				}
				line++;
				*(line-2)='\0';
				*(line-1)='\0';
				continue;
			}
			if(*line=='\"')
			{	
				line++;
				while(*line!='\"')
				{
					*(line-1)=*line;
					line++;
				}
				line++;
				*(line-2)='\0';
				*(line-1)='\0';
				continue;
			}
			line++;  
		}
	}	
	*argv = '\0';        
	return;
}
void callpipe(char *line)
{
	int j=0;
	while(*line!='\0')
	{
		if(*line=='|')
		{	
			pipecount++;
			line++;
			j=0;
			continue;
		}
		array[pipecount][j++]=*line;
		line++;
	}
}
void pipeexecute(char **argv)
{
	pid_t pid;
	int status;
	int b=execvp(*argv,argv);
	if(b<0)
	{
		perror("exec failed\n");
		exit(1);
	}	 
	fflush(stdout);
}
void openpipes()
{
	int i;
	for(i=0;i<=pipecount;i++)
		pipe(pipes+i*2);
}
void closepipes()
{
	int i;
	for(i=0;i<pipecount;i++)
	{
		close(pipes[2*i]);
		close(pipes[2*i+1]);
	}
}
int findpipe(char* stringpipe)
{
	int i,length=strlen(stringpipe);
	for(i=0;i<length;i++)
		if(stringpipe[i]=='|')
			return 1;
	return 0;
}
void pipechildhandler(int signum)
{
	int pid;
	pid = waitpid(WAIT_ANY, NULL, WNOHANG);
	if(signum==SIGCHLD)
	{
		kill( pid, SIGKILL);
		fflush(stdout);
	}return;
}
void  parse(char *line, char **argv)				//parse the input and return the first ptr..
{
	counter=0;
	while (*line!='\0')
	{
		while ((*line == ' ' || *line == '\t' || *line == '\n'))
		{
			*line++ = '\0'; 
		}
		*argv++ = line;
		counter++;
		while(*line != '\0' && *line !=' ' && *line != '\t' && *line != '\n') 
			line++;  
	}	
	*argv = '\0';        
	return;
}
int execute(char **argv)					//executes all fg and bg process except the one's specially mentioned
{
	pid_t  pid;
	int status;
	if ((pid = fork()) < 0) 
	{     /* fork a child process           */
		printf("forking child process failed\n");
		exit(1);
	}
	else if (pid == 0) 
	{          
		int b=execvp(*argv,argv);
		if (b < 0) 
		{     
			perror("exec failed\n");
			exit(1);
		}
		else
		{
		}
	}
	else 
	{               

		if(and==0)					//fg process
		{

			signal(SIGCHLD,sig_handler);  		//changes the handler for the time fg is running to sig_handler
			while(wait(&status)!=pid)
			{

			}
			signal(SIGCHLD,child_handler);		//again after fg terminates default handler is assigned
			return pid;
		}
		else
		{
			printf("Command %s pid %d\n",argv[0],pid);	
			current[histcount-1]=1;
			waitpid(pid,&status, WNOHANG);
			return pid;				//just return without exiting child_handler will take care...
		}
	}
}
void signal1()							//signal initialiser
{
	signal(SIGINT, sig_handler);
	signal(SIGTSTP, sig_handler);
	signal(SIGCHLD, child_handler);
}
int hist_func(char **argv)
{
			int i,end;
			end=histcount;
			if(strcmp(argv[0],"hist")==0)			
			{
				for(i=0;i<end;i++)
					printf("%d. %s\n",i+1,completehistory[i]);
				return 1;
			}
			return 0;

}
int histn_func(char **argv)
{
			int i;
			if(argv[0][0]=='h'&& argv[0][1]=='i' && argv[0][2]=='s' && argv[0][3]=='t')	
			{
				int tencount=0;
				if(argv[0][5]=='\0')
				{
					int var=(int)argv[0][4]-'0',var1=1;
					int start=histcount-1-var,end=histcount-1;
					if(start>0)
						for(i=start;i<end;i++)
							printf("%d. %s\n",var1++,completehistory[i]);
					else
						for(i=0;i<end;i++)
							printf("%d. %s\n",var1++,completehistory[i]);
				}
				else
				{
					int var=(int)argv[0][5]-'0'+10*((int)argv[0][4]-'0'),var1=1;
					int start=histcount-1-var,end=histcount-1;
					if(start>0)
						for(i=start;i<end;i++)
							printf("%d. %s\n",var1++,completehistory[i]);
					else
						for(i=0;i<end;i++)
							printf("%d. %s\n",var1++,completehistory[i]);

				}
				return 1;
			}
			return 0;

}
int pid_func(char **argv)
{
			int i;
			if(strcmp(argv[0],"pid")==0)
			{
				if(counter==1)
				{	
					printf("command name: ./a.out process id:%d\n",getpid());
					return 1;
				}
				if(strcmp(argv[1],"all")==0)
				{
					printf("List of all processes spawned from this shell:\n");
					for(i=0;i<histcount;i++)
					{
						if(pidcount[i]!=-1)
							printf("command name: %s process id: %d\n",history[i],pidcount[i]);
					}
					return 1;
				}
				if(strcmp(argv[1],"current")==0)
				{	
					printf("List of currently executing processes spawned from this shell:\n");
					for(i=0;i<histcount;i++)
					{	if(pidcount[i]!=-1 && current[i]==1)
						printf("command name: %s process id:%d\n",history[i],pidcount[i]);
					}
					return 1;
				}
				printf("pid execution failed\n");
			}
			return 0;

}
int only_redirection(char *line)
{
	while(*line!='\0')
	{
		if(*line=='>'||*line=='<')
			return 1;
		line++;
	}
	return 0;
}
void  main(void)
{
	char  line[1024];             /* the input line                 */
	char  *argv[64];              /* the command line argument      */
	int i;
	char path[100],orignalpath[100];
	getcwd(path,100);		//get the current working dir
	getcwd(orignalpath,100);		//get the current working dir
	a=strlen(path);
	signal1();
	while (1) 
	{	

		pipecount=0;
		if(flaged==0)
		{	
			printpromt();
			gets(line);
		}
		if(line[0]==0x0C)
		{
			strcpy(line,"clear");
		}
		flaged=0;
		signal(SIGINT,SIG_IGN);		//ignores ctrl+l
		signal(SIGTSTP,SIG_IGN);	//
		if(strlen(line)==0)
			continue;
		and=0;				//set default as fg
		if(strlen(line)>1)		
		{
			if(line[strlen(line)-1]=='&')
			{
				and=1;
				line[strlen(line)-1]='\0';
				line[strlen(line)-1]='\0';
			}
			else
				and=0;
		}
		int decide=findpipe(line);
		strcpy(completehistory[histcount],line);		
		pidcount[histcount]=-1;		
		if(decide==0)

		{
			if(only_redirection(line)==1)
			{
				strcpy(history[histcount++],line);		
				redirection(line);
				continue;
			}
			parse(line, argv);				/*   parse the line               */
			strcpy(history[histcount++],argv[0]);		
			if (strcmp(argv[0],"quit") == 0)  		/* is it an "quit"?     */
				exit(0);            			/*   exit if it is                */
			if (strcmp(argv[0],"cd")==0)
			{	
				if(chdir(argv[1])==-1)
				{	
					printf("error in cd\n");
				}
				continue;
			}
			if(hist_func(argv)==1)continue;
			if(histn_func(argv)==1)continue;
			if(pid_func(argv)==1)continue;
			if(argv[0][0]=='!')
			{
				if(argv[0][6]=='\0')
				{
					printf("%s\n",completehistory[(int)argv[0][5]-'0'-1]);	
					strcpy(line,completehistory[(int)argv[0][5]-'0'-1]);
					flaged=1;
				}
				else
				{
					printf("%s\n",completehistory[(((int)argv[0][5]-'0')*10+((int)argv[0][6]-'0'))-1]);
					strcpy(line,completehistory[(((int)argv[0][5]-'0')*10+((int)argv[0][6]-'0'))-1]);
					flaged=1;
				}
				continue;
			}
			else
			{
				pidcount[histcount-1]=execute(argv);           /* otherwise, execute the command */
			}
		}
		else
		{
			pipecount=0;
			callpipe(line);
			openpipes();
			pid_t pid;
			int status;
			int stored_pid;char pid_string[100];
			for(i=0;i<=pipecount;i++)
			{	
				char *argv[100];
				char redirected_string[100];
				strcpy(redirected_string,array[i]);
				pipeparse(array[i],argv);
				if(i==0)
					strcpy(history[histcount++],argv[0]);
				
				pid=fork();
				if(pid==0)
				{
					if(i==0)
					{
						dup2(pipes[1],1);
						if(hist_func(argv)==1){exit(1);continue;}
						if(histn_func(argv)==1){exit(1);continue;}
						if(pid_func(argv)==1){exit(1);continue;}
					}	
					else 
					{
						if(i==pipecount)
						{	
							dup2(pipes[2*(pipecount-1)],0);
						}
						else
						{
							dup2(pipes[2*i-2],0);
							dup2(pipes[2*i+1],1);
						}
					}
					closepipes();
					if(only_redirection(redirected_string)==1)
					{
						redirection(redirected_string);
						exit(1);
						int j;
						for(j=0;j<100;j++)array[i][j]='\0';
						continue;
					}
					int a=execvp(*argv,argv);
					if(a<0)
					{
						perror("exec failed\n");
						exit(1);
					}
				}
				else
				{
					if(i==pipecount)
					{
						strcpy(pid_string,argv[0]);
						pidcount[histcount-1]=pid;           /* otherwise, execute the command */
						stored_pid=pid;
					}
				}
			}
			closepipes();
			int j;
			for(i=0;i<100;i++)
				for(j=0;j<100;j++)
					array[i][j]='\0';
			for(i=0;i<=pipecount;i++)
			{	
				if(i==pipecount && and==1)
				{
					printf("Command %s pid %d\n",pid_string,stored_pid);	
					current[histcount-1]=1;
					waitpid(stored_pid,&status, WNOHANG);
				}	
				else
				{
					signal(SIGCHLD,sig_handler);
					wait(&status);
					signal(SIGCHLD,child_handler);
				}
			}
		}
	}
}
