//auth
let login = require('./components/auth/login.vue').default;
let register = require('./components/auth/register.vue').default;
let forgotpassword = require('./components/auth/forgotpassword.vue').default;
let logout = require('./components/auth/logout.vue').default;

//home
let home =require('./components/home.vue').default;

//employee
let addemployee = require('./components/employee/create.vue').default;
let allemployee = require('./components/employee/index.vue').default;
let editemployee = require('./components/employee/edit.vue').default;

//supplier
let addsupplier = require('./components/supplier/create.vue').default;
let allsupplier = require('./components/supplier/index.vue').default;
let editsupplier = require('./components/supplier/edit.vue').default;

//category
let addcategory = require('./components/category/create.vue').default;
let allcategory = require('./components/category/index.vue').default;
let editcategory = require('./components/category/edit.vue').default;

//product
let addproduct = require('./components/product/create.vue').default;
let allproduct = require('./components/product/index.vue').default;
let editproduct = require('./components/product/edit.vue').default;

//expense
let addexpense = require('./components/expense/create.vue').default;
let allexpense = require('./components/expense/index.vue').default;
let editexpense = require('./components/expense/edit.vue').default;
let dailyexpense = require('./components/expense/daily.vue').default;
let monthlyexpense = require('./components/expense/monthly.vue').default;

//salary
let addsalary = require('./components/salary/create.vue').default;
let allsalary = require('./components/salary/index.vue').default;
let paysalary = require('./components/salary/pay.vue').default;
let viewsalary = require('./components/salary/view.vue').default;

//stock
let allstock = require('./components/stock/index.vue').default;
let editstock = require('./components/stock/edit.vue').default;


export const routes =[
	//auth
	{path:'/',component:login,name:'/'},
	{path:'/register',component:register,name:'register'},
	{path:'/forgot-password',component:forgotpassword,name:'forgotpassword'},
	{path:'/logout',component:logout,name:'logout'},

	//home
	{path:'/dashboard',component:home,name:'dashboard'},

	//employee
	{path:'/add-employee',component:addemployee,name:'addemployee'},
	{path:'/all-employee',component:allemployee,name:'allemployee'},
	{path:'/edit-employee/:id',component:editemployee,name:'editemployee'},
	//supplier
	{path:'/add-supplier',component:addsupplier,name:'addsupplier'},
	{path:'/all-supplier',component:allsupplier,name:'allsupplier'},
	{path:'/edit-supplier/:id',component:editsupplier,name:'editsupplier'},

	//category
	{path:'/add-category',component:addcategory,name:'addcategory'},
	{path:'/all-category',component:allcategory,name:'allcategory'},
	{path:'/edit-category/:id',component:editcategory,name:'editcategory'},

	//product
	{path:'/add-product',component:addproduct,name:'addproduct'},
	{path:'/all-product',component:allproduct,name:'allproduct'},
	{path:'/edit-product/:id',component:editproduct,name:'editproduct'},

	//expense
	{path:'/add-expense',component:addexpense,name:'addexpense'},
	{path:'/all-expense',component:allexpense,name:'allexpense'},
	{path:'/edit-expense/:id',component:editexpense,name:'editexpense'},
	{path:'/today-expense',component:dailyexpense,name:'dailyexpense'},
	{path:'/monthly-expense',component:monthlyexpense,name:'monthlyexpense'},

	//salary
	{path:'/add-salary',component:addsalary,name:'addsalary'},
	{path:'/all-salary',component:allsalary,name:'allsalary'},
	{path:'/pay-salary/:id',component:paysalary,name:'paysalary'},
	{path:'/view-salary/:month/:year',component:viewsalary,name:'viewsalary'},

	//stock
	{path:'/all-stock',component:allstock,name:'allstock'},
	{path:'/edit-stock/:id',component:editstock,name:'editstock'},
]