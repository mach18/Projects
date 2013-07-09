CC = gcc
CFLAGS = -Wall
PROG1 = client1
PROG2 = client2

SRCS1 = Client1.cpp
SRCS2 = Client2.cpp
LIBS = 

all: $(PROG1)

$(PROG1):	$(SRCS1)
	$(CC) $(CFLAGS) -o $(PROG1) $(SRCS1) $(LIBS)
	
all: $(PROG2)

$(PROG2):	$(SRCS2)
	$(CC) $(CFLAGS) -o $(PROG2) $(SRCS2) $(LIBS)
	
clean:
	rm -f $(PROG1)
	rm -f $(PROG2)
