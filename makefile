CC = g++
EXEC = main
FLAGS = -lsfml-system -lsfml-window -lsfml-graphics -std=c++11
SOURCES = main.cpp graphics.cpp ViewPort.cpp IO.cpp Projection.cpp
OBJECTS = main.o graphics.o ViewPort.o IO.o Projection.o

#########main.o: main.cpp main.hpp
#########	${CC} -c main.cpp
#########graphics.o: graphics.cpp graphics.hpp
#########	${CC} -c graphics.cpp
#########ViewPort.o: ViewPort.cpp ViewPort.hpp
#########	${CC} -c ViewPort.cpp
#########IO.o: IO.cpp IO.hpp
#########	${CC} -c IO.cpp
all:
	${CC} ${SOURCES} -o ${EXEC} ${FLAGS}
#
###all: main.o graphics.o ViewPort.o IO.o
###	g++ main.o IO.o graphics.o ViewPort.o -o ${EXEC} ${FLAGS}
###clean:
###	rm -f ${EXEC} *.o
