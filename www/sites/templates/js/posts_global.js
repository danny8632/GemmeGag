
function getHoursSince(date)
{
    var newDate = new Date();
    var newTime = Date.parse(date);

    var currentTime = newDate.getTime();

    var diffInMilli = currentTime - newTime;
    var hoursSince = (((diffInMilli / 1000) / 60) / 60);

    console.log(hoursSince);

    var roundedDown = Math.floor(hoursSince);

    return roundedDown;
}

function getPostType(filePath)
{
    var file_html = ``
    fileExtension = filePath.substr(filePath.lastIndexOf('.') + 1)

    switch (fileExtension)
    {
        case 'mp4':
            file_html = `
            <div class="imgCon">
                <video class="postImage" controls>
                    <source src="${filePath}" type="video/mp4">
                </video>
            </div>
            `
            break
        case 'mp3':

            file_html = `
            <div class="imgCon">
                <video class="postImage" controls>
                    <source src="${filePath}" type="video/mp4">
                </video>
            </div>
            `
            break
        default:
            file_html = `<img class="postImage" src="${filePath}">`
            break
    }
    
    return file_html
}

