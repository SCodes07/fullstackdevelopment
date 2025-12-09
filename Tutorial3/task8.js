const url='https://jsonplaceholder.typicode.com/todos/1';
async function getTodos() {
	try{
		const response = await fetch(url);
		const data =await response.json();
		console.log(data);
		console.log('My today's task is )
	}
	// body...
}