#!/bin/bash
rm /tmp/*.mp3
rm /tmp/*.wav
pico2wave -l=es-ES -w=/tmp/$1.wav "$2"
ffmpeg -i /tmp/$1.wav -acodec mp3 /tmp/$1.mp3
