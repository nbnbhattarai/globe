#include "IO.hpp"
#include "ViewPort.hpp"
#include "Projection.hpp"
#include <SFML/Graphics.hpp>
#include <fstream>

char objfilename[] = "cricket.obj";

int main (void){
    sf::RenderWindow window (sf::VideoMode(800,600), "main");
    ViewPort viewPort (0,0,800,600,&window);
    std::ifstream infile (objfilename);
    OBJ object (infile);
    projection (viewPort, object);
    //printData (object.allVertices);
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
                }
            }
        }
        window.clear (sf::Color::Black);
        object.draw (&viewPort);
        //viewPort.drawLine (Vector2<float>(-1,1), Vector2<float>(1,-1));
        window.display ();
    }
    return 0;
}
