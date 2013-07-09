CC = g++
CFLAGS = -Wall
PROG = 201101011_Assignment1

SRCS = 201101011_Assignment1.cpp
LIBS = -lglut -lGL -lGLU -lm

all: $(PROG)

$(PROG):	$(SRCS)
	$(CC) $(CFLAGS) -o $(PROG) $(SRCS) $(LIBS)

clean:
	rm -f $(PROG)
