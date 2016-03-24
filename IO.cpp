#include "IO.hpp"

/*
void OBJ::interpreatEdgeIn (char *s){

}
*/
int max(int a, int b, int c){
    if (a > b){
        if (a > c)
            return a;
        else
            return c;
    }else{
        if (b > c)
            return b;
        else
            return c;
    }
}

int min (int a, int b, int c){
    if (a < b){
        if (a < c)
            return a;
        else
            return c;
    }else{
        if (b < c)
            return b;
        else
            return c;
    }
}

Vector2<int> max (Vector2<int> a, Vector2<int> b, Vector2<int> c){


    return Vector2<int>(max(a.getX(), b.getX(), c.getX()),
                        max(a.getY(), b.getY(), c.getY()));
}

Vector2<int> min (Vector2<int> a, Vector2<int> b, Vector2<int> c){


    return Vector2<int>(min(a.getX(), b.getX(), c.getX()),
                        min(a.getY(), b.getY(), c.getY()));
}


void OBJ::interpreatEdgeIn (std::string s, int *result){
    //std::cout << "string1 " << s ;
    std::string temp("");
    int ind = 0;
    for (int i = 0; i < s.size(); ++i){
        if(isdigit(s[i])){
            temp += s[i];
        }
        if(!isdigit(s[i+1]) and temp.size() >= 1){
            std::istringstream stream (temp);
            temp = "";
            stream >> result[ind++];
        }
    }
    //std::cout << " = " << result[0] << " " << result[1] << std::endl;
}


void OBJ::loadObject (std::ifstream &ifile){
    while (!ifile.eof()) {
        char s[100];
        float v[3];
        std::string str;
        std::string temp;
        int e[6];
        ifile >> s;
        if (strcmp(s,"v") == 0){
            ifile >> v[0];
            ifile >> v[1];
            ifile >> v[2];
            allVertices.push_back (Vector3<float>(v[0],v[1],v[2]));
            //std::cout << v[0] << " " << v[1] << " " << v[2] << std::endl;
        }else if (strcmp(s,"vn") == 0){
            ifile >> v[0];
            ifile >> v[1];
            ifile >> v[2];
            allNormals.push_back (Vector3<float>(v[0],v[1],v[2]));
            //std::cout << v[0] << " " << v[1] << " " << v[2] << std::endl;
        }else if (strcmp(s,"f") == 0){
            int n[3][3];
            for (int k = 0; k < 3; ++k){
                ifile >> str;
                this->interpreatEdgeIn(str,n[k]);
            }
            allFaces.push_back(Face(n[0][0]-1,n[1][0]-1,n[2][0]-1));
            //std::cout << "face : (" << n[0][0] << "," << n[1][0] << ", " << n[2][0] << ")" << std::endl;
            allFaces.back().setNormalIndex (n[0][2]-1,n[1][2]-1,n[2][2]-1);
            //std::cout << "norm : (" << n[0][2] << "," << n[1][2] << ", " << n[2][2] << ")" << std::endl;
            /*allFaces.push_back (Face(Edge(n[0][0]-1,n[0][1]-1),Edge(n[1][0]-1,n[1][1]-1),
                Edge(n[2][0]-1,n[2][1]-1)));
                */
            /*
            for (int i = 0; i < 3; ++i){
                std::cout << n[i][0] << " and " << n[i][1] << std::endl;
            }*/
        }
    }
}

void Face::draw (ViewPort *vp, OBJ *obj){
/*
    vp->drawLine (obj->allNormalizedVertices[edges[0].getIndex(0)],
                  obj->allNormalizedVertices[edges[0].getIndex(1)]);
    vp->drawLine (obj->allNormalizedVertices[edges[1].getIndex(0)],
                  obj->allNormalizedVertices[edges[1].getIndex(1)]);
    vp->drawLine (obj->allNormalizedVertices[edges[2].getIndex(0)],
                  obj->allNormalizedVertices[edges[2].getIndex(1)]);
*/

    Vector2<int> v1 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getX()]);
    Vector2<int> v2 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getY()]);
    Vector2<int> v3 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getZ()]);

    Vector2<int> minV = min (v1, v2, v3);
    Vector2<int> maxV = max (v1, v2, v3);

    for (int x = minV.getX(); x <= maxV.getX(); x++){
        for (int y = minV.getY(); y <= maxV.getY(); y++){
            if((v1.getX() - v2.getX()) * (y - v1.getY()) - (v1.getY() - v2.getY()) * (x - v1.getX()) > 0 &&
               (v2.getX() - v3.getX()) * (y - v2.getY()) - (v2.getY() - v3.getY()) * (x - v2.getX()) > 0 &&
               (v3.getX() - v1.getX()) * (y - v3.getY()) - (v3.getY() - v1.getY()) * (x - v3.getX()) > 0){
                vp->pixelPlot (Vector2<int>(x,y));
            }
        }
    }

/*
      std::cout << obj->allNormalizedVertices[edges[0].getIndex(0)] << ","
                << obj->allNormalizedVertices[edges[0].getIndex(1)] << " ";
      std::cout << obj->allNormalizedVertices[edges[1].getIndex(0)] << ","
                << obj->allNormalizedVertices[edges[1].getIndex(1)] << " ";
      std::cout << obj->allNormalizedVertices[edges[2].getIndex(0)] << ","
                << obj->allNormalizedVertices[edges[2].getIndex(1)] << " ";


    std::cout << "edge1: " << edges[0].getIndex(0) << "to " << edges[0].getIndex(1) << std::endl
              << "edge2: " << edges[1].getIndex(0) << "to " << edges[1].getIndex(1) << std::endl
              << "edge3: " << edges[2].getIndex(0) << "to " << edges[2].getIndex(1) << std::endl;
              */
}

void OBJ::draw (ViewPort *vp){
    //std::cout << "drawing started" << std::endl;
    allFaces.front().draw(vp, this);
    allFaces.back().draw(vp, this);

    for(std::vector<Face>::iterator it = allFaces.begin(); it != allFaces.end(); ++it){
        it->draw (vp,this);
    }

    //std::cout << "all drawn" << std::endl;
}
