clear;
clc;

    % create a new figure to show the image . 
    newImg = imread('web_teaser3.png')
    figure; imshow(newImg);
%     figure(2);
     % create laplacian filter. 
    H = fspecial('laplacian');
     % apply laplacian filter. 
    blurred = imfilter(newImg,H);
    figure, subplot(1,2,1), imshow(blurred); title('Edge detected Image');
    J = imadjust(blurred,stretchlim(blurred),[]);
    subplot(1,2,2), imshow(J);
    grayImg = rgb2gray(newImg);
    figure, imshow(grayImg);
    edges1 = edge(grayImg);
    figure,subplot(2,2,1), imshow(edges1); title('Edge Detection');
    
     edges2 = edge(grayImg, 'sobel');
    subplot(2,2,2), imshow(edges2); title('Sobel algorithm');
    
    edges3 = edge(grayImg, 'prewitt');
    subplot(2,2,3), imshow(edges3); title('Prewitt algorithm');
    
    edges4 = edge(grayImg, 'roberts');
    subplot(2,2,4), imshow(edges4); title('Roberts algorithm');
    
    edges5 = edge(grayImg, 'log');
    figure,subplot(1,2,1), imshow(edges5); title('Log algorithm');
    
    edges6 = edge(grayImg, 'canny');
    subplot(1,2,2), imshow(edges6); title('Canny algorithm');