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
int max (int, int, int);
int min (int, int, int);
Vector2<int> max (Vector2<int>, Vector2<int>, Vector2<int>);
Vector2<int> min (Vector2<int>, Vector2<int>, Vector2<int>);

class Edge{
private:
    Vector2<int> vertexIndex;
public:
    Edge (){}
    Edge (int v1, int v2){
        vertexIndex.setCoordinate (v1,v2);
    }

    void setIndex (int v1, int v2){
        vertexIndex.setCoordinate (v1, v2);
    }

    Vector2<int> getIndex (void){
        return vertexIndex;
    }
};

class Face{
private:
    Vector3<Edge> edges;
public:
    Vector3<int> vertexIndex;
    Vector3<int> normalIndex;
    Face (){}
    Face (int a, int b, int c){
        vertexIndex.setCoordinate (a,b,c);
        edges.setCoordinate(Edge(a,b),
                            Edge(b,c),
                            Edge(c,a));
    }

    Face (Edge e1, Edge e2, Edge e3){
        edges.setCoordinate (e1, e2, e3);
    }

    void setEdge (Vector3<Edge> edges){
        this->edges = edges;
    }

    void setNormalIndex (int a, int b, int c){
        normalIndex.setCoordinate (a,b,c);
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
