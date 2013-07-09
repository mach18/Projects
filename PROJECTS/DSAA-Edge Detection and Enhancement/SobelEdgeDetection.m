function [ output_args ] = SobelEdgeDetection( Image )

maskX = [-1 0 1 ; -2 0 2; -1 0 1];
maskY = [-1 -2 -1 ; 0 0 0 ; 1 2 1] ;

resX = conv2(rgb2gray(Image), maskX);
resY = conv2(rgb2gray(Image), maskY);

magnitude = sqrt(resX.^2 + resY.^2);
direction = atan(resY/resX);
thresh = magnitude < 101;
magnitude(thresh) = 0;
showImage(magnitude);

end