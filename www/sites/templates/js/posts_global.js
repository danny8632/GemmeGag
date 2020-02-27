
function getTimeSince(date) {
    var dateType = "";
    var result = "";
    var newDate = new Date();
    var newTime = Date.parse(date);

    var currentTime = newDate.getTime();

    var diffInMilli = currentTime - newTime;
    var minutesSince = Math.floor(((diffInMilli / 1000) / 60));
    minutesSince > 1 ? dateType = "minutes" : dateType = "minute";
    result = `${minutesSince} ${dateType} ago`;

    if (minutesSince > 60) {
        var hoursSince = Math.floor(minutesSince / 60);
        hoursSince > 1 ? dateType = "hours" : dateType = "hour";
        result = `${hoursSince} ${dateType} ago`;

        if (hoursSince > 24) {
            var daysSince = Math.floor(hoursSince / 24);
            daysSince > 1 ? dateType = "days" : dateType = "day";
            result = `${daysSince} ${dateType} ago`;

            if (daysSince >= 7) {
                var weeksSince = Math.floor(daysSince / 7);
                weeksSince > 1 ? dateType = "weeks" : dateType = "week";
                result = `${weeksSince} ${dateType} ago`;

                if (weeksSince >= 4) {
                    var monthsSince = Math.floor(weeksSince / 4);
                    monthsSince > 1 ? dateType = "months" : dateType = "month";
                    result = `${monthsSince} ${dateType} ago`;

                    if (monthsSince >= 24) {
                        var yearsSince = Math.floor(monthsSince / 24);
                        yearsSince > 1 ? dateType = "years" : dateType = "year";
                        result = `${yearsSince} ${dateType} ago`;
                    }
                }
            }
        }
    }

    return result;
}

function getPostType(filePath) {
    var file_html = ``;
    fileExtension = filePath.substr(filePath.lastIndexOf('.') + 1);

    switch (fileExtension) {
        case 'mp4':
            file_html = `
            <div class="imgCon">
                <video class="postImage" controls>
                    <source src="${filePath}" type="video/mp4">
                </video>
            </div>
            `
            break;
        case 'mp3':

            file_html = `
            <div class="imgCon">
                <video class="postImage" controls>
                    <source src="${filePath}" type="video/mp4">
                </video>
            </div>
            `
            break;
        default:
            file_html = `<img class="postImage" src="${filePath}">`;
            break;
    }

    return file_html;
}

