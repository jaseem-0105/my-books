import React from "react";
import Navbar from "../../components/layouts/navbar/Navbar";
import Footer from "../../components/layouts/footer/Footer";
import CartItemsContainer from "../../components/layouts/cart-items-container/CartItemsContainer";

const Cartpage = () => {
    return(
        <section>
            <Navbar darkTheme={true}/>

             <CartItemsContainer />

            <Footer />
        </section>
    )
}
export default Cartpage
