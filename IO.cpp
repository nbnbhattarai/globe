#include "IO.hpp"

/*
void OBJ::interpreatEdgeIn (char *s){

}
*/
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
            int n[3][2];
            for (int k = 0; k < 3; ++k){
                ifile >> str;
                this->interpreatEdgeIn(str,n[k]);
            }
            allFaces.push_back (Face(Edge(n[0][0]-1,n[0][1]-1),Edge(n[1][0]-1,n[1][1]-1),
                Edge(n[2][0]-1,n[2][1]-1)));
            /*
            for (int i = 0; i < 3; ++i){
                std::cout << n[i][0] << " and " << n[i][1] << std::endl;
            }*/
        }
    }
}

void Face::draw (ViewPort *vp, OBJ *obj){

    vp->drawLine (obj->allNormalizedVertices[edges[0].getIndex(0)],
                  obj->allNormalizedVertices[edges[0].getIndex(1)]);
    vp->drawLine (obj->allNormalizedVertices[edges[1].getIndex(0)],
                  obj->allNormalizedVertices[edges[1].getIndex(1)]);
    vp->drawLine (obj->allNormalizedVertices[edges[2].getIndex(0)],
                  obj->allNormalizedVertices[edges[2].getIndex(1)]);
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
