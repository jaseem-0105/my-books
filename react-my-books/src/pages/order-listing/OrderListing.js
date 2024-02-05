import React, { useEffect } from "react";
import Navbar from "../../components/layouts/navbar/Navbar";
import Footer from "../../components/layouts/footer/Footer";
import OrderListingContainer from "../../components/layouts/order-listing-container/OrderListingContainer"
import { useDispatch, useSelector } from "react-redux";
import { myOrders } from "../../redux/user/userSlice";

const OrderListing = () => {
    const dispatch = useDispatch();
    const user = useSelector((state) => state.user.user);

    useEffect(() => {
       dispatch(myOrders({token:user?.user?.auth_token}))
    }, []);
    return (
        <section>
            <Navbar darkTheme={true} />

            <OrderListingContainer />

            <Footer />
        </section>
    );
};

export default OrderListing;
