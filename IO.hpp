#ifndef IO_HPP
#define IO_HPP
#include <iostream>
#include <sstream>
#include <vector>
#include <cstring>
#include <fstream>
#include <cmath>
#include "graphics.hpp"
#include "ViewPort.hpp"

class OBJ;

class Edge{
private:
    unsigned int index1, index2;
public:
    Edge (){}
    Edge (unsigned int v1, unsigned int v2){
        index1 = v1;
        index2 = v2;
    }

    void setIndex (unsigned int v1, unsigned int v2){
        index1 = v1;
        index2 = v2;
    }

    int getIndex(int i){
        if (i == 0){
            return index1;
        }else{
            return index2;
        }
    }
};

class Face{
private:
     Edge edges[3];
public:
    Face (){}
    Face (Edge e1, Edge e2, Edge e3){
        edges[0] = e1;
        edges[1] = e2;
        edges[2] = e3;
    }

    void setEdge (int index, Edge e){
        edges[index] = e;
    }

    void draw (ViewPort *,OBJ *);
};

class ZBufferElement {
private:
    float z;
    unsigned int index;
public:
    ZBufferElement (float z, unsigned int index){
        this->z = z;
        this->index = index;
    }
};

class OBJ{
    public:
        std::vector<Vector3<float> > allVertices;
        std::vector<Face> allFaces;
        std::vector<Vector3<float> > allNormals;
        std::vector<Vector2<float> > allNormalizedVertices;
        std::vector<ZBufferElement> zBuffer;

        void interpreatEdgeIn (std::string s, int *result);

    public:
        OBJ (){}
        OBJ (std::ifstream &infile){
            this->loadObject (infile);
        }
        void loadObject (std::ifstream &ifile);

        void draw (ViewPort *);

        std::vector<Vector3<float> > getAllVertice ();
        std::vector<Vector3<float> > getAllNormals ();
        std::vector<Face> getAllFaces ();
};

#endif
