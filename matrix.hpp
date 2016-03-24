#ifndef MATRIX_HPP
#define MATRIX_HPP

#include <iostream>

class Matrix{
private:
    float** data;
    unsigned int row;
    unsigned int column;
public:
    Matrix(unsigned int row=4, unsigned int column=4){
        this->row = row;
        this->column = column;
        data = new float*[row];
        for (int i = 0; i < row; ++i)
            data[i] = new float[column];
    }

    float& operator()(unsigned int r, unsigned int c) {
        return data[r][c];
    }

    void operator = (Matrix m2){
        for (int i = 0; i < 4; ++i){
            for (int j = 0; j < 4; ++j){
                data[i][j] = m2(i,j);
            }
        }
    }

    Matrix operator * (Matrix &m2){
        Matrix result;
        float a = 0;
        for (int r = 0; r < 4; ++r){
            for (int c = 0; c < 4; ++c){
                for (int k = 0; k < 4; ++k)
                    a += data[r][k]*m2(k,c);
                result(r,c) = a;
                a = 0;
            }
        }
        return result;
    }

    unsigned int numRows(void){
        return this->row;
    }
    unsigned int numColumns (void){
        return this->column;
    }

    void print (void){
        std::cout << std::endl;
        for (int i = 0; i < row; ++i){
            for (int j = 0; j < column; ++j){
                std::cout << data[i][j] << " ";
            }
        std::cout << std::endl;
        }
    }

};

#endif
