% function test()
clc; % Clear the command window.
close all; % Close all figures (except those of imtool.)
imtool close all; % Close all imtool figures.
clear; % Erase all existing variables.
workspace; % Make sure the workspace panel is showing.
fontSize = 20;

% Change the current folder to the folder of this m-file.
if(~isdeployed)
cd(fileparts(which(mfilename)));
end

% Read in a standard MATLAB gray scale demo image.
folder = 'C:\Program Files\MATLAB\R2010a\toolbox\images\imdemos';
baseFileName = 'cameraman.tif';
% fullFileName = fullfile(folder, baseFileName);
fullFileName = 'web_teaser.jpg';
grayImage = imread(fullFileName);
% Get the dimensions of the image. numberOfColorBands should be = 1.
[rows columns numberOfColorBands] = size(grayImage);
% Display the original gray scale image.
subplot(2, 2, 1);
imshow(grayImage, []);
title('Original Grayscale Image', 'FontSize', fontSize);
% Enlarge figure to full screen.
set(gcf, 'Position', get(0,'Screensize'));
set(gcf,'name','Demo by ImageAnalyst','numbertitle','off')

% Cast to floating so we can see both + and - edges.
grayImage = single(grayImage);

% Get a vertical Prewitt filter kernel:
prewittKernelV = [-1 -1 -1; 0 0 0; 1 1 1];
% Do the filtering.
outputImageV = imfilter(grayImage, prewittKernelV, 'same');
% Display the original gray scale image.
subplot(2, 2, 2);
imshow(outputImageV, []);
title('Vertical Prewitt Filtered Image', 'FontSize', fontSize);

% Get a vertical Prewitt filter kernel:
prewittKernelH = [-1 0 1; -1 0 1; -1 0 1];
% Do the filtering.
outputImageH = imfilter(grayImage, prewittKernelH, 'same');
% Display the original gray scale image.
subplot(2, 2, 4);
imshow(outputImageH, []);
title('Horizontal Prewitt Filtered Image', 'FontSize', fontSize);

outputImageG = uint8(sqrt(single(outputImageH).^2 + single(outputImageV).^2));
% Display the original gray scale image.
subplot(2, 2, 3);
imshow(outputImageG, []);
title('Both Prewitt Filtered Image', 'FontSize', fontSize);