clc;clear;
i = imread('web_teaser.jpg');
h = fspecial('laplacian')
matrix = [0,0,0;0,1,0;0,0,0];
h = matrix - h;
i2 = imfilter(i, h);
figure, subplot(1,2,1), imshow(i); title('Original Image');
subplot(1,2,2), imshow(i2); title('Edge sharpened Image');

% clc;clear;
i = imread('web_teaser2.png');
h = fspecial('laplacian');
matrix = [0,0,0;0,1,0;0,0,0];
h = matrix - h;
i2 = imfilter(i, h);
figure, subplot(1,2,1), imshow(i); title('Original Image');
subplot(1,2,2), imshow(i2); title('Edge sharpened Image');

% clc;clear;
i = imread('web_teaser3.png');
h = fspecial('laplacian');
matrix = [0,0,0;0,1,0;0,0,0];
h = matrix - h;
i2 = imfilter(i, h);
figure, subplot(1,2,1), imshow(i); title('Original Image');
subplot(1,2,2), imshow(i2); title('Edge sharpened Image');

% clc;clear;
i = imread('web_teaser4.gif');
h = fspecial('laplacian');
matrix = [0,0,0;0,1,0;0,0,0];
h = matrix - h;
i2 = imfilter(i, h);
figure, subplot(1,2,1), imshow(i); title('Original Image');
subplot(1,2,2), imshow(i2); title('Edge sharpened Image');