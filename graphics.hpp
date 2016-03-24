#ifndef GRAPHICS_H
#define GRAPHICS_H
#include <SFML/Graphics.hpp>
#include <vector>
#include <iostream>

template <typename T>
class Vector3 {
private:
    T x;
    T y;
    T z;
    int color;
    float intensity;
public:
    Vector3 (){};
    Vector3 (T x, T y, T z, int color = 0, float intensity=1.0){
        this->x = x;
        this->y = y;
        this->z = z;
        this->color = color;
        this->intensity=intensity;
    }

    void setCoordinate (T x, T y,T z){
        this->x = x;
        this->y = y;
        this->z = z;
    }

    void setColor (int color){
        this->color = color;
    }
    void setIntensity (float intensity){
        this->intensity = intensity;
    }
    T getX (void){ return this->x; }
    T getY (void){ return this->y; }
    T getZ (void){ return this->z; }
    int getColor (void){ return this->color; }
    float getIntensity (void) { return this->intensity; }
    float getMagnitude (void){
        return sqrt (x*x + y*y + z*z);
    }

    Vector3<T> getUnitVector (void){
        float magnitude = this->getMagnitude();
        return Vector3<T>(x/magnitude, y/magnitude, z/magnitude);
    }

    Vector3<T> crossProduct (Vector3<T> v){
        T cx, cy, cz;
        cx = y*v.getZ() - z*v.getY();
        cy = v.getX()*z - x*v.getZ();
        cz = x*v.getY() - y*v.getX();
        return Vector3<T>(cx, cy, cz);
    }

    void operator = (Vector3<T> v){
        this->x = v.getX();
        this->y = v.getY();
        this->z = v.getZ();
    }
};

template <typename T>
class Vector2 {
    private:
        T x;
        T y;
        Vector3<int> color;
        float intensity;
    public:
        Vector2 (){}
        Vector2 (T x, T y, Vector3<int> color = Vector3<int>(255,255,255), float intensity=1){
            this->x = x;
            this->y = y;
            this->color = color;
            this->intensity = intensity;
        }
        void setCoordinate (T x, T y){
            this->x = x;
            this->y = y;
        }
        void setColor (Vector3<int> color){
            this->color = color;
        }
        void setIntensity (float intensity){
            this->intensity = intensity;
        }

        void setX (T xn){
            x = xn;
        }
        void setY (T yn){
            y = yn;
        }
        T getX (void){ return this->x; }
        T getY (void){ return this->y; }
        Vector3<int> getColor (void){ return this->color; }
        float getIntensity (void){ return intensity; }
        void operator = (Vector2<T> v){
            this->x = v.getX();
            this->y = v.getY();
        }
        void print (void){
            std::cout << "(" << this->x << ", " << this->y << ")" << std::endl;
        }
};


void printData (std::vector<Vector3<float> > data);
void printData (std::vector<Vector2<float> > data);
#endif
