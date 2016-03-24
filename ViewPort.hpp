#ifndef ViewPort_HPP
#define ViewPort_HPP
#include "graphics.hpp"
#include <SFML/Graphics.hpp>
#include <cmath>

class ViewPort {
    private:
        unsigned int topX;
        unsigned int topY;
        unsigned int height;
        unsigned int width;
        sf::RenderWindow *window;
        Vector3<float> cameraPosition;
        Vector3<float> lookAtPoint;
        Vector3<float> v; // view up vector
        float Zvp;
        int color;
    public:
        float *zBuffer;
        ViewPort (unsigned int topX, unsigned int topY, unsigned int width, unsigned int height, sf::RenderWindow *window){
            this->topX = topX;
            this->topY = topY;
            this->height = height;
            this->width = width;
            this->window = window;

            zBuffer = new float[width * height];
            for (int i = 0; i < (width * height); ++i)
                zBuffer[i] = 54353523;

            cameraPosition = Vector3<float>(50,5,5);
            lookAtPoint = Vector3<float>(0,0,0);
            v = Vector3<float>(0, 0, 35);
            Zvp = 10;
        }
        Vector3<float> getCameraPosition (void){
            return cameraPosition;
        }
        Vector3<float> getLookAtPoint (void){
            return lookAtPoint;
        }
        Vector3<float> getV (void){
            return v;
        }
        float getZvp (void){
            return Zvp;
        }

        void pixelPlot (Vector2<int> v);
        void removePixelPlot (Vector2<int> &v);
        void drawLine (Vector2<float> v1, Vector2<float> v2);

        Vector2<int> getActualCoordinate (Vector2<float> normalc);

};
#endif
