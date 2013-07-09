#include<stdio.h>
#include<string.h>
int main()
{
//insert into events values("md",nfjkc,kn);
while(1)
{
int a;
scanf("%d",&a);
printf("mysql_query(\"insert into events values(%d,",a);
char b[3];
scanf("%s",b);
printf("'%s',1,'",b);
char c;
scanf("%c",&c);
scanf("%c",&c);
while(c!='\n')
{
if(c!='\'')printf("%c",c);
scanf("%c",&c);
}
char d=')';
printf("',$var,NULL%c\");\n",d);
if(a==25 && b[0]=='D')
	break;
}
}
