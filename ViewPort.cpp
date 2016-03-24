#include "ViewPort.hpp"

void ViewPort::pixelPlot (Vector2<int> v){
    sf::VertexArray va (sf::Points, 1);
    va[0].position = sf::Vector2f (v.getX()+this->topX, v.getY()+this->topY);
    window->draw (va);
}

void ViewPort::removePixelPlot (Vector2<int> &v){
    sf::Vertex vertex (sf::Vector2f(v.getX()+this->topX,v.getY()+this->topY));
    vertex.color = sf::Color::Blue;
}

void ViewPort::drawLine (Vector2<float> v1, Vector2<float> v2){
    sf::VertexArray va(sf::Lines, 2);
    Vector2<int> v1i = getActualCoordinate (v1);
    Vector2<int> v2i = getActualCoordinate (v2);
    /*
    if (abs(v1i.getX()) > width)
        v1i.setX (width);
    if (abs(v1i.getY()) > height)
        v1i.setX (height);
    if (abs(v2i.getX()) > width)
        v1i.setY (width);
    if (abs(v2i.getY()) > height)
        v1i.setY (height);
        */

    //std::cout << "vertex1: "; v1i.print();
    //std::cout << "vertex2: "; v2i.print();

    va[0].position = sf::Vector2f(v1i.getX()+this->topX, v1i.getY()+this->topY);
    va[0].color = sf::Color(v1.getColor().getX(), v1.getColor().getY(), v1.getColor().getZ());
    va[1].position = sf::Vector2f(v2i.getX()+this->topX, v2i.getY()+this->topY);
    va[1].color = sf::Color(v2.getColor().getX(), v2.getColor().getY(), v2.getColor().getZ());
    window->draw(va);

    /*
    float dx = v2.getX() - v1.getX();
    float dy = v2.getY() - v2.getY();
    float xinc;
    float yinc;

    if(v2.getX() > v1.getX())
        xinc = 1;
    else
        xinc = -1;

    if(v2.getY() > v2.getY())
        yinc = 1;
    else
        yinc = -1;

    float pk;
    float xk = v1.getX(),yk = v1.getY();

    if(abs(dx) > abs(dy)){
        pk = 2*dy - dx;
        for (int k = 0; k < abs(dx); ++k){
            this->pixelPlot(Vector2<int>(xk,yk));
            if(pk < 0){
                xk += xinc;
                pk += 2 * dy;
            }else{
                xk += xinc;
                yk += yinc;
                pk += 2 * dy - dx;
            }
            std::cout << "(" << xk << " ," << yk << ")" << std::endl;
        }
    }else{
        pk = 2 * dx - dy;
        for (int k = 0; k < abs(dy); k++){
            this->pixelPlot (Vector2<int>(xk,yk));
            if(pk < 0){
                xk += xinc;
                pk += 2 * dy;
            }else{
                xk += xinc;
                pk += 2 * dy - dx;
            }
        }
    }
    */
}

Vector2<int> ViewPort::getActualCoordinate (Vector2<float> normalc){
    return Vector2<int>(static_cast<int>((normalc.getX()+1)*0.5*(width-1)),
                        static_cast<int>((-normalc.getY()+1)*0.5*(height-1)));
                        /*
    return Vector2<int>(static_cast<int>((normalc.getX()+1)*0.5*(width-1)),
                        static_cast<int>((1-(normalc.getY()+1)*0.5)*(height-1)));
                        */
}
