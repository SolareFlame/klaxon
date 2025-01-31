const { spawn } = require('child_process');
const http = require('http');
const { URL } = require('url');
const { config } = require('dotenv');

const result = config();
if (result.error) {
    console.error(result.error.message);
    process.exit(1);
}

const url = 'https://music.youtube.com/watch?v=p7DnxRRuqzM&si=JUR5KF5IuLhaIzI1';

const ytDlpProcess = spawn('yt-dlp', ['-o', '-', '-f', 'bestaudio', url, '--no-playlist']);

ytDlpProcess.stderr.on('data', (data) => {
    console.error(`yt-dlp error: ${data}`);
});

ytDlpProcess.on('close', (code) => {
    console.log(`yt-dlp exited with code ${code}`);
});

const icecastUrl = `icecast://source:${process.env.PASS}@${process.env.HOST}:${process.env.PORT}${process.env.MOUNT}`;

const ffmpegProcess = spawn('ffmpeg', [
    '-re',
    '-i', 'pipe:0',
    '-ac', '2',
    '-b:a', '128k',
    '-ar', '44100',
    '-acodec', 'libmp3lame',
    '-f', 'mp3',
    icecastUrl,
    '-hide_banner',
]);

ytDlpProcess.stdout.pipe(ffmpegProcess.stdin);

ffmpegProcess.on('error', (err) => {
    console.error(`Error in ffmpeg stream: ${err}`);
});

ffmpegProcess.stderr.on('data', (data) => {
    console.error(`ffmpeg stderr: ${data}`);
});

ffmpegProcess.on('close', (code) => {
    console.log(`ffmpeg exited with code ${code}`);
});
