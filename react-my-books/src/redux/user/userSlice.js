import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import axios from "axios";
import {  LOGIN_URL, MY_ORDERS_URL, REGISTER_URL,  } from '../../config/apis';

const initialState = {
  auth_loading: false,
  user: [],
  my_orders:[],
  user_loading: false,
};


export const login = createAsyncThunk(
  "auth/login",
  async ({ email, password, thunkAPI }) => {
    try {
      const response = await axios.post(LOGIN_URL, {
        email, password
      });
      return response.data;
    } catch (err) {
      console.log(err);

      return thunkAPI.rejectWithValue(err.response.data);
    }
  }
);

export const myOrders = createAsyncThunk(
    "auth/myOrder",
    async ({ token, thunkAPI }) => {
      try {
        const response = await axios.post(MY_ORDERS_URL, {
          token
        });
        return response.data;
      } catch (err) {
        console.log(err);

        return thunkAPI.rejectWithValue(err.response.data);
      }
    }
  );
export const register = createAsyncThunk(
  "auth/register",
  async ({ name, email, password, thunkAPI }) => {
    try {
      const response = await axios.post(REGISTER_URL, {
        name, email, password
      });
      return response.data;
    } catch (err) {
      console.log(err);

      return thunkAPI.rejectWithValue(err.response.data);
    }
  }
);



const userSlice = createSlice({
  name: "user",
  initialState: initialState,

  reducers: {
    logoutUser: (state) => {
      state.user = [];
    },

    // loginUser: (state, { payload }) => {
    //     state.user = payload;
    //   },

  },
  extraReducers: builder => {
    builder
      .addCase(login.pending, state => {
        state.auth_loading = true;
      })
      .addCase(login.fulfilled, (state, action) => {
        state.auth_loading = false;

        state.user = action.payload;
      })
      .addCase(login.rejected, (state, action) => {
        state.auth_loading = false;

        state.error = true;
      })
      .addCase(register.pending, state => {
        state.auth_loading = true;
      })
      .addCase(register.fulfilled, (state, action) => {
        state.auth_loading = false;

        state.user = action.payload;
      })
      .addCase(register.rejected, (state, action) => {
        state.auth_loading = false;

        state.error = true;
      }).addCase(myOrders.pending, state => {
        state.auth_loading = true;
      })
      .addCase(myOrders.fulfilled, (state, action) => {
        state.auth_loading = false;

        state.my_orders = action.payload;
      })
      .addCase(myOrders.rejected, (state, action) => {
        state.auth_loading = false;

        state.error = true;
      })
  },
});

export const { logoutUser } = userSlice.actions;

export default userSlice.reducer;
