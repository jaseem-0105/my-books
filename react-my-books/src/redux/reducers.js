import { combineReducers } from "redux";
import userSlice from "./user/userSlice";
import cartSlice from "./cart/cartSlice";


const rootReducer = combineReducers({
  user:userSlice,
  cart:cartSlice,
});

export default rootReducer;
