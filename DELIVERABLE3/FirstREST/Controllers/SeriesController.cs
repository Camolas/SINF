using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;


namespace FirstREST.Controllers
{
    public class SeriesController : ApiController
    {
        //
        // GET: /Series/

        public IEnumerable<Lib_Primavera.Model.Serie> Get()
        {
            return Lib_Primavera.PriIntegration.GetSeries();
        }

    }
}
