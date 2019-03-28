# 视频截图输出
# -i video.mp4 视频源
# -f image2 图片格式
# -ss 00:00 开始时间
# -t 10:00 结束时间
# -r 0.2 频率,5秒一次 (1 => 一秒一次, 0.1 => 10 秒一次)
# ./pics/%3d.jpg 输出路径和格式
ffmpeg -i video.mp4 -f image2 -ss 00:00 -t 10:00 -r 0.2 ./pics/%3d.jpg

# 获取视频时长
ffmpeg -i video.mp4 2>&1 | grep duration -i
