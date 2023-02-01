import { api } from "boot/axios";

export const doLogin = async ({ commit, dispatch }, payload) => {
  await api.post("/api/login", payload).then((response) => {
    const token = response.data;

    commit("setToken", token.access_token);
    api.defaults.headers.common.Authorization = "Bearer " + token.access_token;
    // dispatch('getMe', token)
  });
};

export const signOut = async ({ commit }) => {
  // alert()
  localStorage.removeItem("token");

  await api.post("/api/logout").then((response) => {
    const token = response.data;
    delete api.defaults.headers.common["Authorization"];
    commit("removeToken");
  });
};

// export const getMe = async ({ commit }, token) => {
//   await api.get('/api/v1/users/me/', token.access).then(response => {
//     commit('setMe', response.data)
//   })
// }

export const init = async ({ commit, dispatch }) => {
  const token = localStorage.getItem("token");
  console.log("test " + JSON.parse(token));
  if (token) {
    await commit("setToken", JSON.parse(token));
    api.defaults.headers.common.Authorization = "Bearer " + JSON.parse(token);
    // dispatch('getMe', JSON.parse(token))
  } else {
    commit("removeToken");
  }
};
