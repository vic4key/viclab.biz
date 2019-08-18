function sleep(ms)
{
	var time = new Date().getTime();
	while(new Date().getTime() < time + ms) {}
}