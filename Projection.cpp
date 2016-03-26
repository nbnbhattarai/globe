#include "Projection.hpp"
// nothing


void projection (ViewPort &viewPort, OBJ &object){
    /*std::vector<Vector3<float> > vertices,
     Vector3<float> camera,
     Vector3<float> lookAt,
     Vector3<float> v,
     float Zvp,
     std::vector<ZBufferElement> *zbuffer)*/

     //
        float l = -10, r = 11, b = -10, t = 15;
     //

    Vector3<int> camera = viewPort.getCameraPosition();
    Vector3<float> lookAt =  viewPort.getLookAtPoint();
    Vector3<float> v = viewPort.getViewUp();

    float Zvp = viewPort.getZvp();

    std::vector<Vector2<float> > result;

    int index = 0;
    float Xp=0, Yp=0; // projection points on viewing plane

    Vector3<float> unitN = Vector3<float>(lookAt.getX()-camera.getX(), lookAt.getY()-camera.getY(), lookAt.getZ()-camera.getZ());
    unitN = unitN.getUnitVector();

    Vector3<float> unitV = v.getUnitVector();
    Vector3<float> unitU = unitN.crossProduct (unitV);
    unitN = unitU.crossProduct(unitV);
    Matrix translation;
    Matrix rotation;
    translation(0,0) = 1; translation(0,1) = 0; translation(0,2) = 0; translation(0,3) = -camera.getX();
    translation(1,0) = 0; translation(1,1) = 1; translation(1,2) = 0; translation(1,3) = -camera.getY();
    translation(2,0) = 0; translation(2,1) = 0; translation(2,2) = 1; translation(2,3) = -camera.getZ();
    translation(3,0) = 0; translation(3,1) = 0; translation(3,2) = 0; translation(3,3) = 1;

    rotation(0,0) = unitU.getX(); rotation(0,1) = unitU.getY(); rotation(0,2) = unitU.getZ(); rotation(0,3) = 0;
    rotation(1,0) = unitV.getX(); rotation(1,1) = unitV.getY(); rotation(1,2) = unitV.getZ(); rotation(1,3) = 0;
    rotation(2,0) = unitN.getX(); rotation(2,1) = unitN.getY(); rotation(2,2) = unitN.getZ(); rotation(2,3) = 0;
    rotation(3,0) = 0; rotation(3,1) = 0; rotation(3,2) = 0; rotation(3,3) = 1;

    float Zprp =  static_cast<float>(camera.getZ());
    float Xprp = 0, Yprp = 0; // Xprp,Yprp = 0 -> projection reference point in Zv axis
    float dp = Zprp - Zvp;
    Matrix vcs;
    vcs = rotation * translation;

    Matrix projectionMatrix;
    projectionMatrix(0,0) = 1; projectionMatrix(0,1) = 0; projectionMatrix(0,2) = 0; projectionMatrix(0,3) = 0;
    projectionMatrix(1,0) = 0; projectionMatrix(1,1) = 1; projectionMatrix(1,2) = 0; projectionMatrix(1,3) = 0;
    projectionMatrix(2,0) = 0; projectionMatrix(2,1) = 0; projectionMatrix(2,2) = -Zvp/dp; projectionMatrix(2,3) = Zvp*(Zprp/dp);
    projectionMatrix(3,0) = 0; projectionMatrix(3,1) = 0; projectionMatrix(3,2) = -1.0/dp; projectionMatrix(3,3) = Zprp/dp;

    Matrix vpMatrix;
    vpMatrix = projectionMatrix * vcs;
    Matrix viewingCoordinate (4,1);
    Matrix vertexMatrix(4,1);
    float h;
    object.allNormalizedVertices.erase (object.allNormalizedVertices.begin(),object.allNormalizedVertices.end());
    for(std::vector<Vector3<float> >::iterator it = object.allVertices.begin(); it != object.allVertices.end(); ++it){
        vertexMatrix(0,0) = it->getX(); vertexMatrix(1,0) = it->getY(); vertexMatrix(2,0) = it->getZ();
        vertexMatrix(3,0) = 1;
        viewingCoordinate = vcs*vertexMatrix;
        //vpMatrix.print();
        //std::cout << "viewing matrix:" << std::endl;
        //viewingCoordinate.print();

        vertexMatrix = vpMatrix * vertexMatrix;
        //std::cout << "vertex matrix:" << std::endl;
        //vertexMatrix.print();

        h = vertexMatrix(3,0);
        Xp = vertexMatrix(0,0)/h;
        Yp = vertexMatrix(1,0)/h;

        object.zBuffer.push_back(ZBufferElement(viewingCoordinate(2,0), index++));

        Xp = (2*Xp-r-l)*(1.0/static_cast<float>(r-l));
        Yp = (2*Yp-t-b)*(1.0/static_cast<float>(t-b));

        //std::cout << "xp = " << Xp << " , yp = " << Yp << std::endl;
        object.allNormalizedVertices.push_back(Vector2<float>(Xp, Yp));
    }
}
