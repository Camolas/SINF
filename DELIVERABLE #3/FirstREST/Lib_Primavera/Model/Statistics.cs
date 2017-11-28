using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace FirstREST.Lib_Primavera.Model
{
    public class Statistics
    {
        public List<ProductUnitsSold> most_sold_products
        {
            get;
            set;
        }

        public List<ProductIncome> most_income_products
        {
            get;
            set;
        }
    }
}
