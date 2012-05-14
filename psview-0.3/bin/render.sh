#!/bin/sh

# Set the memory managment
# -m max memory (RSS)
# -v max virtual memory
ulimit -m 1024 -v 32768 -c 0

#check if anything in argument string. If not then don't try to render
if [ "$3" != "" ]
then
    # decide what to do based on the format
    if [ $3 = "1" ]
    then
	# docx
	echo "Converting word file..."
	nice /usr/bin/abiword --to=html "$1$2.infile"
	mv "$1$2.html" "$1$2/indexTemp.html"
	echo "<A HREF=\"../../index.php?room=$4\" >Upload a new file</A>" > $1/$2/index.html
   	cat $1$2/indexTemp.html >> $1$2/index.html
    elif [ $3 = "4" ]
    then
	# Word doc
	echo "Converting word file..."
	nice /usr/bin/wvHtml --targetdir=$1$2 "$1$2.infile" index.html
    elif [ $3 = "2" ] || [ $3 = "3" ]
    then
	# pdf or ps
	#after download - convert to pcx
	echo "Converting ps or pdf...$1$2"
	nice /usr/bin/ghostscript -dBATCH -dNOPAUSE -sDEVICE=pcx256 -r150x150 -sOutputFile="$1$2/tmp%d" "$1$2.infile"


	echo "nice /usr/bin/ghostscript -dBATCH -dNOPAUSE -sDEVICE=pcx256 -r150x150 -sOutputFile=\"$1$2/tmp%d\" \"$1$2.infile\""
	#from pcx->gif
	echo "<br>" 
	echo "$1$2"
	for dff in $1$2/*
	do 
	    echo "Converting $dff" 
	    `nice /usr/bin/convert "$dff" "$dff".gif`
	    rm "$dff"
	done
    else
	# skip
	echo "skip"
    fi
else
    echo "<br>Internal error<br>"
    echo "$1 $2 $3"
fi




