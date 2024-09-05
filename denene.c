#include <stdio.h>
#include <string.h>

int main(){
int n;
scanf("%d", &n);
char asgv[1024];
while(n > 0){
    fgets(asgv, sizeof(char), stdin);
    n--;
}
printf("%s", asgv);
return 0;
}