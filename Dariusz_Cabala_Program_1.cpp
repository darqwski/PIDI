#include <iostream>

    using namespace std;

     int mergeSort(int * arr, int size);///Zwraca liczbe inwersji calej tablicy
    int mergeSort_mergeSort(int * arr, int * temp, int leftIndex, int rightIndex); ///Zwraca liczbe inwersji w array, od left do right
    int mergeSort_merge(int * arr, int * temp, int leftIndex, int midIndex, int rightIndex);///Zwraca poukladane tablice


    int mergeSort_mergeSort(int * arr, int * temp, int leftIndex, int rightIndex){
        int midIndex, counter = 0;
        if (rightIndex > leftIndex){                                  ///Rozdziel tablice na dwie mniejsze przez pol
            midIndex = (rightIndex + leftIndex)/2;                         ///Az dojdzie do sytuacji gdy tabliy bedzia miala 1 element
            counter  = mergeSort_mergeSort(arr, temp, leftIndex, midIndex);
            counter += mergeSort_mergeSort(arr, temp, midIndex+1, rightIndex);
            counter += mergeSort_merge(arr, temp, leftIndex, midIndex+1, rightIndex);
            }
        return counter;
        }
  int mergeSort(int * arr, int size){
        int *temp = new int[size];
        return mergeSort_mergeSort(arr, temp, 0, size - 1);
        }

            /**
            Przyklad Dzialania merge
            arr[1 2 3 4 1 3 5 6], temp[]
            B=oznaczenie ze juz bylo
            [1 2 3 4 1 3 5 6],[]
            i=0;
            j=4;
            arr[0]<=arr[4]  TRU
            [B 2 3 4 1 3 5 6],[1]
            arr[1]<=arr[4] FALS
            [B 2 3 4 B 3 5 6],[1,1]
            INV+=mid-i czyli 4-1 poniewaz tyle arr[4] jest tez mniejsze od arr[1,2,3]
            arr[1]<=arr[5] TRU
            [B B 3 4 B 3 5 6],[1,1,2]
            arr[2]<=arr[5] TRU
            [B B B 4 B 3 5 6],[1,1,2,3]
            arr[3]<=arr[5] FALS
            [B B B 4 B B 5 6],[1,1,2,3,3]
            arr[3]<=arr[6] TRUE
            [B B B B B B 5 6],[1,1,2,3,3,4]
            PETLA SKONCZONA!
            */

    int mergeSort_merge(int * arr, int * temp, int left, int mid, int right){///MERGE ZWRACA TABLICE POUKLADANA TYLKO W OD LEFT OD MID I MID+1 DO RIGHT
    int leftIndex, rightIndex, tempIndex;                                                   ///RESZTA SIE NIE LICZU
    int counter = 0;
    leftIndex = left;
    rightIndex = mid;
    tempIndex = left;
    while ((leftIndex <= mid - 1) && (rightIndex <= right)){     ///Petla uklada w tempie array ktory jest ulozony do polowy
        if (arr[leftIndex] <= arr[rightIndex])
            temp[tempIndex++] = arr[leftIndex++];
        else{
            temp[tempIndex++] = arr[rightIndex++];
            counter = counter + (mid - leftIndex);  ///Oraz dodaje liczbe koniecznych inwersji w zależnosci od pozycji
            }
  }

    while (leftIndex <= mid - 1)
        temp[tempIndex++] = arr[leftIndex++];
    while (rightIndex <= right)
        temp[tempIndex++] = arr[rightIndex++];  ///WSADZ RESZTE
    for (int i=left; i <= right; i++)
        arr[i] = temp[i];
        ///WLOZ TEMPA DO ARRAYA
    return counter;
}

    int main(){

        int * tab=new int[10];
        for(int i=0;i<10;i++)tab[i]=i;
          for(int i=0;i<10;i++)cout<<tab[i]<<",";
        cout<<" : ";
        cout<<mergeSort(tab, 10)<<endl;
        for(int i=9;i>=0;i--)tab[9-i]=i;
          for(int i=0;i<10;i++)cout<<tab[i]<<",";
        cout<<" : ";
        cout<<mergeSort(tab, 10)<<endl;
         for(int i=0;i<10;i++)tab[i]=i*17%10;
         for(int i=0;i<10;i++)cout<<tab[i]<<",";
        cout<<" : ";
          cout<<mergeSort(tab, 10)<<endl;


        return 0;
        }
