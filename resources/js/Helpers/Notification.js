class Notification{
	success(){
		new Noty({
			type:"success",
			layout:"topRight",
			text:"Successfully Done",
			timeout:1000
		}).show();
	}

	alert(){
		new Noty({
			type:"alert",
			layout:"topRight",
			text:"Are You Sure?",
			timeout:1000
		}).show();
	}

	error(){
		new Noty({
			type:"error",
			layout:"topRight",
			text:"Something Wrong !",
			timeout:1000
		}).show();
	}

	warning(){
		new Noty({
			type:"warning",
			layout:"topRight",
			text:"Oops ! Wrong !",
			timeout:1000
		}).show();
	}

	image(){
		new Noty({
			type:"error",
			layout:"topRight",
			text:"Image must be less than 1 MB !",
			timeout:1000
		}).show();
	}

	salaryAlert(){
		new Noty({
			type:"error",
			layout:"topRight",
			text:"This Month Salary Haave Already Given !",
			timeout:1000
		}).show();
	}
}

export default Notification = new Notification()