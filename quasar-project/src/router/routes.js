const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        meta: { requireLogin: true },
      },
    ],
  },
  {
    path: "/",
    component: () => import("src/layouts/Login.vue"),
    children: [
      {
        name: "LoginIn",
        path: "auth/login",
        component: () => import("pages/users/Login.vue"),
      },
    ],
  },
  {
    path: "/",
    component: () => import("src/layouts/MainLayout.vue"),
    children: [
      {
        path: "dashboard",
        component: () => import("src/pages/dashboard/IndexDashboard.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "users",
        component: () => import("src/pages/users/IndexUsers.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/joblevel",
        name: "joblevel",
        component: () => import("src/pages/joblevel/indexJoblevel.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "joblevel/form-input-level",
        component: () => import("src/pages/joblevel/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "joblevel/form-edit-level/:id?",
        component: () => import("src/pages/joblevel/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/jobgrade",
        name: "jobgrade",
        component: () => import("src/pages/jobgrade/indexJobgrade.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "jobgrade/form-input-grade",
        component: () => import("src/pages/jobgrade/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "jobgrade/form-edit-grade/:id?",
        component: () => import("src/pages/jobgrade/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/jobtitle",
        name: "jobtitle",
        component: () => import("src/pages/jobtitle/indexJobtitle.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "jobtitle/form-input-title",
        component: () => import("src/pages/jobtitle/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "jobtitle/form-edit-title/:id?",
        component: () => import("src/pages/jobtitle/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/departement",
        name: "departement",
        component: () => import("src/pages/departement/IndexDepartement.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "departement/form-edit-departement/:id?",
        component: () => import("src/pages/departement/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "departement/form-input-departement",
        component: () => import("src/pages/departement/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/client",
        name: "client",
        component: () => import("src/pages/client/IndexClient.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "client/form-edit-client/:id?",
        component: () => import("src/pages/client/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "client/form-input-client",
        component: () => import("src/pages/client/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/religi",
        name: "religi",
        component: () => import("src/pages/religi/IndexReligi.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "religi/form-edit-religi/:id?",
        component: () => import("src/pages/religi/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "religi/form-input-religi",
        component: () => import("src/pages/religi/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/marriage-status",
        name: "marriage-status",
        component: () =>
          import("src/pages/marriage_status/IndexMarriagestatus.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "marriage-status/form-edit-marriage-status/:id?",
        component: () => import("src/pages/marriage_status/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "marriage-status/form-input-marriage-status",
        component: () => import("src/pages/marriage_status/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/tax-status",
        name: "tax-status",
        component: () => import("src/pages/tax_status/IndexTaxstatus.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "tax-status/form-edit-tax-status/:id?",
        component: () => import("src/pages/tax_status/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "tax-status/form-input-tax-status",
        component: () => import("src/pages/tax_status/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/blood-type",
        name: "blood-type",
        component: () => import("src/pages/blood_type/IndexBloodtype.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "blood-type/form-edit-blood-type/:id?",
        component: () => import("src/pages/blood_type/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "blood-type/form-input-blood-type",
        component: () => import("src/pages/blood_type/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/bank",
        name: "bank",
        component: () => import("src/pages/bank/IndexBank.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "bank/form-edit-bank/:id?",
        component: () => import("src/pages/bank/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "bank/form-input-bank",
        component: () => import("src/pages/bank/FormAdd.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "/employee",
        name: "employee",
        component: () => import("src/pages/employee/IndexEmployee.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "employee/form-edit-employee/:id?",
        component: () => import("src/pages/employee/FormEdit.vue"),
        meta: { requireLogin: true },
      },
      {
        path: "employee/form-input-employee",
        component: () => import("src/pages/employee/FormAdd.vue"),
        meta: { requireLogin: true },
      },
    ],
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
