#include "IO.hpp"
#include "ViewPort.hpp"
#include "Projection.hpp"
#include <SFML/Graphics.hpp>
#include <fstream>

char objfilename[] = "globe_table.obj";

Vector3<int> cameraPosition (28,19,-60);
Vector3<float> lookAtPoint (0,0,0);
Vector3<float> viewUp (-26,245,58);
float Zvp = -43;

float firstRotateX = 40 * 5;
float firstRotateY = 2 * 5;

int main (int argc, char *argv[]){
    bool wireframe = true;
    if (argc < 2){
        std::cout << "Usage: ./main [name of obj file to load]" << std::endl;
        return -1;
    }else{
        for (int i = 1; i < argc; ++i){
            if (strcmp (argv[i],"-s") == 0)
                wireframe = false;
        }
    }
    strcpy (objfilename, argv[1]);
    sf::RenderWindow window (sf::VideoMode(1300,720), "main");
    sf::RectangleShape rectangle (sf::Vector2f(10,10));
    rectangle.setSize (sf::Vector2f(1300,700));
    rectangle.setOutlineThickness (3);
    rectangle.setOutlineColor(sf::Color::Blue);
    ViewPort viewPort (5,5,1300,700,&window);
    viewPort.setCameraPosition (cameraPosition);
    std::ifstream infile (objfilename);
    OBJ object (infile);

    object.rotateX (firstRotateX);
    object.rotateY(firstRotateY);

    projection (viewPort, object);
    printData (object.allVertices);
    //printData (object.allNormalizedVertices);
    //printData (object.allNormals);
    while (window.isOpen()) {
        sf::Event event;
        while (window.pollEvent(event)) {
            if(event.type == sf::Event::Closed)
                window.close();
            if (event.type == sf::Event::KeyPressed){
                if (event.key.code == sf::Keyboard::Escape){
                    window.close ();
                }else if (event.key.code == sf::Keyboard::Q){
                    cameraPosition.xInc (1);
                }else if (event.key.code == sf::Keyboard::W){
                    cameraPosition.xInc (-1);
                }else if (event.key.code == sf::Keyboard::E){
                    cameraPosition.yInc (1);
                }else if (event.key.code == sf::Keyboard::R){
                    cameraPosition.yInc (-1);
                }else if (event.key.code == sf::Keyboard::T){
                    cameraPosition.zInc (1);
                }else if (event.key.code == sf::Keyboard::Y){
                    cameraPosition.zInc (-1);
                }else if (event.key.code == sf::Keyboard::A){
                    viewUp.xInc (1);
                }else if (event.key.code == sf::Keyboard::S){
                    viewUp.xInc (-1);
                }else if (event.key.code == sf::Keyboard::D){
                    viewUp.yInc (1);
                }else if (event.key.code == sf::Keyboard::F){
                    viewUp.yInc (-1);
                }else if (event.key.code == sf::Keyboard::G){
                    viewUp.zInc (1);
                }else if (event.key.code == sf::Keyboard::H){
                    viewUp.zInc (-1);
                }else if (event.key.code == sf::Keyboard::Z){
                    Zvp++;
                }else if (event.key.code == sf::Keyboard::X){
                    Zvp--;
                }else if (event.key.code == sf::Keyboard::C){
                    lookAtPoint.xInc (1);
                }else if (event.key.code == sf::Keyboard::V){
                    lookAtPoint.xInc (-1);
                }else if (event.key.code == sf::Keyboard::B){
                    lookAtPoint.yInc (1);
                }else if (event.key.code == sf::Keyboard::N){
                    lookAtPoint.yInc (-1);
                }else if (event.key.code == sf::Keyboard::M){
                    lookAtPoint.zInc (1);
                }else if (event.key.code == sf::Keyboard::Comma){
                    lookAtPoint.zInc (-1);
                }else if (event.key.code == sf::Keyboard::Numpad1){
                    object.rotateX(1);
                    printData (object.allVertices);
                }else if (event.key.code == sf::Keyboard::Numpad2){
                    object.rotateX(-1);
                }else if (event.key.code == sf::Keyboard::Numpad3){
                    object.rotateY(1);
                }else if (event.key.code == sf::Keyboard::Numpad4){
                    object.rotateY(-1);
                }else if (event.key.code == sf::Keyboard::Numpad5){
                    object.rotateZ(1);
                }else if (event.key.code == sf::Keyboard::Numpad6){
                    object.rotateZ(-1);
                }

                std::cout << "cameraPosition: (" << cameraPosition.getX()
                          << ", " << cameraPosition.getY()
                          << ", " << cameraPosition.getZ() << ")" << std::endl;
                std::cout << "vieUp: (" << viewUp.getX()
                          << ", " << viewUp.getY()
                          << ", " << viewUp.getZ() << ")" << std::endl;

                std::cout << "LookAt: (" << lookAtPoint.getX()
                          << ", " << lookAtPoint.getY()
                          << ", " << lookAtPoint.getZ() << ")" << std::endl;

                std::cout << "Zvp : " << Zvp << std::endl;
            }
        }
        viewPort.setLookAtPoint(lookAtPoint);
        viewPort.setZvp (Zvp);
        viewPort.setCameraPosition (cameraPosition);
        viewPort.setViewUp (viewUp);
        //printData (object.allNormalizedVertices);

        projection (viewPort, object);
        window.clear (sf::Color::Black);
        window.draw(rectangle);
        object.draw (&viewPort,wireframe);
        //viewPort.drawLine (Vector2<float>(-1,1), Vector2<float>(1,-1));
        window.display ();
    }
    return 0;
}
