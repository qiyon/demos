#include "demo.h"

int demoMultiply(int a, int b) {
    int res = a*b;
    printf("C multiply: %d*%d=%d\n",a,b,res);
    return res;
}

void demoStrPrint(char* str) {
    printf("C demoClangPrint: %s\n",str);
}
