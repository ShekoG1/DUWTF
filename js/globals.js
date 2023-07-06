function sleep(num) {
	let now = new Date();
	const stop = now.getTime() + num;
	while(true) {
		now = new Date();
		if(now.getTime() > stop) return;
	}
}