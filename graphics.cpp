#include "graphics.hpp"

void printData (std::vector<Vector3<float> > data){
    for (std::vector<Vector3<float> >::iterator it = data.begin(); it != data.end(); ++it){
        std::cout << "(" << it->getX() << ", " << it->getY() << ", " << it->getZ() << ")\n";
    }
}
void printData (std::vector<Vector2<float> > data){
    for (std::vector<Vector2<float> >::iterator it = data.begin(); it != data.end(); ++it){
        std::cout << "(" << it->getX() << ", " << it->getY() << ")\n";
    }
}
