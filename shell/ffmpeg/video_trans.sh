# 查看视频信息
ffmpeg -i input_video.mp4

# 转码 指定码率
ffmpeg -i input_video.mp4 -c:v libx264 -b:v 1000k output_video.mp4
# 转码 压缩，指定分辨率
ffmpeg -i input_video.mp4 -c:v libx264 -preset medium -crf 23 -s 1280x720 output_video_x264.mp4

# 参数说明
# -c:v libx264 指定了视频编码器为H.264
# -b:v 1000k 指定了目标视频的平均码率为 1000kbps（视频质量和文件大小的控制参数）
# -preset medium 是x264的预设选项之一。medium预设，它是速度和压缩效率的一个平衡点。
# -crf 23 是控制视频质量的参数，CRF值（Constant Rate Factor）范围是0-51，值越小质量越高。
# -s 1280x720 设置视频分辨率为1280x720，降低分辨率可以减小文件大小。
# -r 24 设置视频帧率为24帧/秒，降低帧率也可以减小文件大小。
# -c:a copy 表示音频流不进行编码，直接复制到输出文件中，保持音频质量不变
