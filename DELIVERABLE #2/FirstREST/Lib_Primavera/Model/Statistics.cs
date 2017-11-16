using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;

namespace FirstREST.Lib_Primavera.Model
{
    public class Statistics : ApiController
    {
        public string most_sold_product_name
        {
            get;
            set;
        }

        public string most_profitable_product_name
        {
            get;
            set;
        }
    }
}
