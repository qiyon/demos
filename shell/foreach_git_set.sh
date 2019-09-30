#!/usr/bin/env bash
for dir in `ls`;
do
	if [ -d "$dir" ]; then
		cd $dir
		pwd
		if [ -d ".git" ]; then
			echo "git directory, config..."
			git config user.name "your_git_name"
			git config user.email "your@gitmail.com"
		fi
		cd ../
	fi
done
