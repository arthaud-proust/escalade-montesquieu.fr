const publicVapidKey = "BH25QhGzdhhFsj8D0Ws71rdpwvW4q_PuqHZRDmZpRoDlItnhRMQ9zvnTT4rfIklgWKxIkFfqqMu49ibGqfiaGlc";
window._push_host = "https://escalade-montesquieu-pusher.herokuapp.com";
// window._push_host = "http://localhost:8001";
// Check for service worker
if ("serviceWorker" in navigator) {
	send().catch(e => console.error(e));
}
function getForumsLastMessages() {
	// console.log(Object.keys(localStorage));
	// let body = {forums:{}};
	// for (const forumName of Object.keys(localStorage).filter(key=>key.includes('.last_message'))) {
	// 	body.forums[forumName.split('.')[0]] = localStorage.getItem(forumName);
	// }
	// axios({
	// 	method: 'post',
	// 	url: `${window._push_host}/last-messages`,
	// 	data: JSON.stringify(body),
	// 	headers: {
	// 		"content-type": "application/json",
	// 	}
	// })
	// .then(r=>{
	// 	const forumsToNotif = r.data;
	// 	let newMessages = false
		
	// 	for(const [forumName, hasNewMessages] of Object.entries(r.data)) {
	// 		console.log(`${forumName.split('.')[0]}: ${hasNewMessages?'nouveaux messages':'à jour'}`);
	// 		if(hasNewMessages ) {
	// 			$(`.link-forum[data-forum="${forumName.split('.')[0]}"]`).addClass('has-new-messages');
	// 			newMessages = true;
	// 		}
	// 	}
	// 	if(newMessages ) {
	// 		$(`.nav-link-forums`).addClass('has-new-messages')
	// 		$(`.navbar-toggler`).addClass('has-new-messages')
	// 	}
	// })
	axios({
		method: 'get',
		url: `${window._push_host}/last-messages`,
	})
	.then(r=>{
		let newMessages = false

		for(const [forumName, lastDate] of Object.entries(r.data)) {
			if(localStorage.getItem(forumName+'.last_message')!==null) {
				console.log(' ');
				console.log("Server "+JSON.parse(new Date(lastDate).getTime()));
				console.log("Client "+JSON.parse(localStorage.getItem(forumName+'.last_message')));
				if( (JSON.parse(new Date(lastDate).getTime()) - JSON.parse(localStorage.getItem(forumName+'.last_message')) ) > 2000 ) {
					newMessages = true
					console.log(`${forumName.split('.')[0]}: nouveaux messages (${lastDate})`);
					$(`.link-forum[data-forum="${forumName.split('.')[0]}"]`).addClass('has-new-messages');
					newMessages = true;
				} else {
					console.log(`${forumName.split('.')[0]}: à jour (${lastDate})`);
				}
			} else {
				$(`.link-forum[data-forum="${forumName.split('.')[0]}"]`).addClass('has-new-messages');
				newMessages = true;
			}
		}
		console.log(newMessages);
		if(newMessages ) {
			$(`.nav-link-forums`).addClass('has-new-messages')
			$(`.navbar-toggler`).addClass('has-new-messages')
		}
	})
}

getForumsLastMessages();
async function send() {
	navigator.serviceWorker.register("/js/worker.js" )
		.then(onRegistration);
}

function onRegistration(registration) {
	if (registration.waiting) {
	  	registration.waiting.addEventListener('statechange', onStateChange('waiting', registration));
	}
  
	if (registration.installing) {
	  	registration.installing.addEventListener('statechange', onStateChange('installing', registration));
	}
  
	if (registration.active) {
		registration.active.addEventListener('statechange', onStateChange('active', registration));
	}
  }
  
function onStateChange(from, registration) {
	return function(e) {
		console.log(`From ${from} to ${e.target.state}`);
	  	if(e.target.state == 'activated') {
			registerPush(registration);
	  	}
	}
}

function registerPush(register) {
	// Register Push
	register.pushManager.subscribe({
		userVisibleOnly: true,
		applicationServerKey: urlBase64ToUint8Array(publicVapidKey),
	})
	.then(function(subscription) {
		console.log('Subscribing');
		fetch(`${window._push_host}/subscribe`, {
			method: "POST",
			body: JSON.stringify(subscription),
			headers: {
				"content-type": "application/json",
			},
		})
	})
}



function urlBase64ToUint8Array(base64String) {
	const padding = "=".repeat((4 - (base64String.length % 4)) % 4);
	const base64 = (base64String + padding)
		.replace(/\-/g, "+")
		.replace(/_/g, "/");

	const rawData = window.atob(base64);
	const outputArray = new Uint8Array(rawData.length);

	for (let i = 0; i < rawData.length; ++i) {
		outputArray[i] = rawData.charCodeAt(i);
	}
	return outputArray;
}


