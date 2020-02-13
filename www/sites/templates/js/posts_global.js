
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

