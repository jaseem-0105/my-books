import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import { PLACE_ORDER_URL } from "../../config/apis";
import axios from "axios";

const initialState = {
    orderitems: [],
    totalAmount: 0,
};

export const addOrder = createAsyncThunk(
    "placeOrder",
    async ({ token, orderitems, total_amount, thunkAPI }) => {
        try {
            const response = await axios.post(PLACE_ORDER_URL, {
                token,
                orderitems,
                total_amount,
            });
            return response.data;
        } catch (err) {
            console.log(err);

            return thunkAPI.rejectWithValue(err.response.data);
        }
    }
);

export const cartSlice = createSlice({
    name: "cart",
    initialState: initialState,
    reducers: {
        addToCart: (state, action) => {
            const { orderitems, totalAmount } = state;
            const { id, name, price, image } = action.payload;
            const item = orderitems.find((item) => item.id === id);
            let currentTotal = totalAmount;
            if (item) {
                item.quantity += 1;
                item.totalPrice = (item.price * item.quantity).toFixed(2);
                currentTotal = parseFloat(currentTotal) + parseFloat(price);
                // alert(currentTotal)
            } else {
                orderitems.push({
                    id,
                    name,
                    price,
                    quantity: 1,
                    totalPrice: price,
                    image,
                });
                currentTotal = parseFloat(currentTotal) + parseFloat(price);
            }
            state.totalAmount = currentTotal;
        },
        removeFromCart: (state, action) => {
            const { orderitems, totalAmount } = state;

            const { id } = action.payload;
            const item = orderitems.find((item) => item.id === id);
            let currentTotal = totalAmount;
            if (item) {
                item.quantity -= 1;

                item.totalPrice = (item.price * item.quantity).toFixed(3);
                currentTotal -= item.price;
                if (item.quantity === 0) {
                    const index = orderitems.indexOf(item);
                    orderitems.splice(index, 1);
                    if (orderitems.length === 0) {
                        currentTotal = 0;
                    }
                }

                state.totalAmount = currentTotal;
            }
        },
        clearCart: (state) => {
            state.orderitems = [];
            state.totalAmount = 0;
        },
    },
});

export const { addToCart, removeFromCart, clearCart } = cartSlice.actions;

export default cartSlice.reducer;
