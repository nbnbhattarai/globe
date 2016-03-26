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
        Vector3<int> cameraPosition;
        Vector3<float> lookAtPoint;
        Vector3<float> v; // view up vector
        Vector3<float> lightSourcePosition;
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

            cameraPosition = Vector3<int>(5,5,5);
            lookAtPoint = Vector3<float>(0,0,0);
            v = Vector3<float>(10, 20, 35);
            Zvp = 25;
            lightSourcePosition = Vector3<float>(30,30,30);
        }

        void setLightSourcePosition (Vector3<float> pos){
            lightSourcePosition = pos;
        }

        Vector3<float> getLightSourcePosition (void){
            return lightSourcePosition;
        }

        Vector3<int> getCameraPosition (void){
            return cameraPosition;
        }
        Vector3<float> getLookAtPoint (void){
            return lookAtPoint;
        }
        Vector3<float> getViewUp (void){
            return v;
        }
        void setZvp (float zvp){
            this->Zvp = zvp;
        }

        void setViewUp (Vector3<float> v){
            this->v = v;
        }

        void setLookAtPoint (Vector3<float> la){
            this->lookAtPoint = la;
        }

        float getZvp (void){
            return Zvp;
        }

        void setCameraPosition (Vector3<int> pos){
            cameraPosition.setCoordinate (pos.getX(), pos.getY(), pos.getZ());
        }

        //it plot pixel with Vector2 coordinate and it's properties
        void pixelPlot (Vector2<int> v);
        void removePixelPlot (Vector2<int> &v);
        
        //it draws line when we give actual coordinate (nor normalized)
        void drawLine (Vector2<int> v1, Vector2<int> v2);

        //it returns actual (viewport) coordinate when we give it a normalized coordinate
        Vector2<int> getActualCoordinate (Vector2<float> normalc);

        void lineClipping (Vector2<int> *, Vector2<int> *);

};
#endif
