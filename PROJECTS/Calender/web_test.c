#include<stdio.h>
int main()
{
        char c;int count=0;
        scanf("%c",&c);
        while(c!=EOF)
        {
                if(c=='<')
                        count++;
                if(count==0)
                        printf("%c",c);
                if(c=='>')
                {
                        count--;
                        printf("\n");
                }
                scanf("%c",&c);
        }
        return 0;
}
