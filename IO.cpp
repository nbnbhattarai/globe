#include "IO.hpp"

/*
void OBJ::interpreatEdgeIn (char *s){

}
*/

float distance (Vector2<int> a, Vector2<int> b){
    return sqrt (((a.getX()-b.getX()) * (a.getX() - b.getX())) + ((a.getY()-b.getY()) * (a.getY()-b.getY())));
}

void OBJ::rotateX (float theta){
    Matrix transMatrix(4,4);
    Matrix vertexMatrix(4,1);
    float angle = theta/180*pi;
    transMatrix(0,0) = 1;     transMatrix(0,1) = 0;         transMatrix(0,2) = 0;             transMatrix(0,3) = 0;
    transMatrix(1,0) = 0;     transMatrix(1,1) = cos(angle);transMatrix(1,2) = -sin(angle);   transMatrix(1,3) = 0;
    transMatrix(2,0) = 0;     transMatrix(2,1) = sin(angle);transMatrix(2,2) = cos(angle);    transMatrix(2,3) = 0;
    transMatrix(3,0) = 0;     transMatrix(3,1) = 0;         transMatrix(3,2) = 0;             transMatrix(3,3) = 1;

    for(std::vector<Vector3<float> >::iterator it = allVertices.begin();
        it != allVertices.end(); ++it){
            vertexMatrix(0,0) = it->getX(); vertexMatrix(1,0) = it->getY(); vertexMatrix(2,0) = it->getZ(); vertexMatrix(3,0) = 1;
            vertexMatrix = transMatrix * vertexMatrix;
            it->setCoordinate (vertexMatrix(0,0), vertexMatrix(1,0), vertexMatrix(2,0));
        }
}

void OBJ::rotateY (float theta){
    Matrix transMatrix(4,4);
    Matrix vertexMatrix(4,1);
    float angle = theta/180*pi;
    transMatrix(0,0) = cos(angle);    transMatrix(0,1) = 0;         transMatrix(0,2) = sin(angle);    transMatrix(0,3) = 0;
    transMatrix(1,0) = 0;             transMatrix(1,1) = 1;         transMatrix(1,2) = 0;             transMatrix(1,3) = 0;
    transMatrix(2,0) = -sin(angle);   transMatrix(2,1) = 0;         transMatrix(2,2) = cos(angle);    transMatrix(2,3) = 0;
    transMatrix(3,0) = 0;             transMatrix(3,1) = 0;         transMatrix(3,2) = 0;             transMatrix(3,3) = 1;

    for(std::vector<Vector3<float> >::iterator it = allVertices.begin();
        it != allVertices.end(); ++it){
            vertexMatrix(0,0) = it->getX(); vertexMatrix(1,0) = it->getY(); vertexMatrix(2,0) = it->getZ(); vertexMatrix(3,0) = 1;
            vertexMatrix = transMatrix * vertexMatrix;
            it->setCoordinate (vertexMatrix(0,0), vertexMatrix(1,0), vertexMatrix(2,0));
        }
}

void OBJ::rotateZ (float theta){
    Matrix transMatrix(4,4);
    Matrix vertexMatrix(4,1);
    float angle = theta/180*pi;

    transMatrix(0,0) = cos(angle);    transMatrix(0,1) = -sin(theta);       transMatrix(0,2) = 0;    transMatrix(0,3) = 0;
    transMatrix(1,0) = sin(angle);    transMatrix(1,1) = cos(theta);        transMatrix(1,2) = 0;    transMatrix(1,3) = 0;
    transMatrix(2,0) = 0;             transMatrix(2,1) = 0;                 transMatrix(2,2) = 1;    transMatrix(2,3) = 0;
    transMatrix(3,0) = 0;             transMatrix(3,1) = 0;                 transMatrix(3,2) = 0;    transMatrix(3,3) = 1;

    for(std::vector<Vector3<float> >::iterator it = allVertices.begin();
        it != allVertices.end(); ++it){
            vertexMatrix(0,0) = it->getX(); vertexMatrix(1,0) = it->getY(); vertexMatrix(2,0) = it->getZ(); vertexMatrix(3,0) = 1;
            vertexMatrix = transMatrix * vertexMatrix;
            it->setCoordinate (vertexMatrix(0,0), vertexMatrix(1,0), vertexMatrix(2,0));
        }
}

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

// if wireframe is true, it draw wireframe, if not it draws solid object
void Face::draw (ViewPort *vp, OBJ *obj,bool wireframe){

// This code for wireframe design
    if (wireframe){
        Vector2<int> v1 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getX()]);
        Vector2<int> v2 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getY()]);
        Vector2<int> v3 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getZ()]);

        Vector2<int> minV = min (v1, v2, v3);
        Vector2<int> maxV = max (v1, v2, v3);

        vp->drawLine(v1, v2);
        vp->drawLine(v2, v3);
        vp->drawLine(v1, v3);
    }else{
// This below for solid object design
    //Vector3<float> normal = obj->allNormals[normalIndex];
    //float dotProduct = normal.dotProduct(vp->getLightSourcePosition());
    //dotProduct *= 2;
    //normal.multiplyBy (dotProduct);
    //normal = normal - vp->getLightSourcePosition();
    Vector2<int> v1 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getX()]);
    Vector2<int> v2 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getY()]);
    Vector2<int> v3 = vp->getActualCoordinate(obj->allNormalizedVertices[vertexIndex.getZ()]);

    Vector2<int> minV = min (v1, v2, v3);
    Vector2<int> maxV = max (v1, v2, v3);

    float distanceZ = 0.0;
    for (int x = minV.getX(); x <= maxV.getX(); x++){
        for (int y = minV.getY(); y <= maxV.getY(); y++){
            if((v1.getX() - v2.getX()) * (y - v1.getY()) - (v1.getY() - v2.getY()) * (x - v1.getX()) > 0 &&
               (v2.getX() - v3.getX()) * (y - v2.getY()) - (v2.getY() - v3.getY()) * (x - v2.getX()) > 0 &&
               (v3.getX() - v1.getX()) * (y - v3.getY()) - (v3.getY() - v1.getY()) * (x - v3.getX()) > 0){
                   distanceZ = distance (Vector2<int>(x,y), Vector2<int>(vp->getLightSourcePosition().getX(),vp->getLightSourcePosition().getY()));
                vp->pixelPlot (Vector2<int>(x,y,Vector3<int>(0,0,200),distanceZ/2000.0));
            }
        }
    }
    }
}

void OBJ::draw (ViewPort *vp,bool wireframe){
    allFaces.front().draw(vp, this);
    allFaces.back().draw(vp, this);

    for(std::vector<Face>::iterator it = allFaces.begin(); it != allFaces.end(); ++it){
        it->draw (vp,this,wireframe);
    }
}
