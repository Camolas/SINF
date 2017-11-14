using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;

namespace FirstREST.Controllers
{
    public class OpportunitiesController : ApiController
    {
        // GET: /opportunities/?representative_id=<representative_id>
        public IEnumerable<Opportunity> Get(string representative_id)
        {
            return Lib_Primavera.PriIntegration.ListOpportunities(representative_id);
        }

        // POST: /opportunities
        public HttpResponseMessage Post(Opportunity opportunity)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            erro = Lib_Primavera.PriIntegration.InsertOpportunityObj(opportunity);
            if (erro.Erro == 0)
            {
                var response = Request.CreateResponse(HttpStatusCode.Created, opportunity);
                string uri = Url.Link("DefaultApi", new { id = opportunity.opportunity_id });
                response.Headers.Location = new Uri(uri);
                return response;
            }
            else
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, "It was not possible to create the opportunity.");
            }
        }

        // PUT: /opportunities/?opportunity_id=<opportunity_id>
        public HttpResponseMessage Put(string opportunity_id, Opportunity opportunity)
        {
            opportunity.opportunity_id = opportunity_id;
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            try
            {
                erro = Lib_Primavera.PriIntegration.UpdOpportunity(opportunity);
                if (erro.Erro == 0)
                {
                    return Request.CreateResponse(HttpStatusCode.OK, erro.Descricao);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound, erro.Descricao);
                }
            }
            catch (Exception exc)
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, erro.Descricao);
            }
        }

        // DELETE: /opportunities/?opportunity_id=<opportunity_id>
        public HttpResponseMessage Delete(string opportunity_id)
        {
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            try
            {
                erro = Lib_Primavera.PriIntegration.DelOpportunity(opportunity_id);
                if (erro.Erro == 0)
                {
                    return Request.CreateResponse(HttpStatusCode.OK, erro.Descricao);
                }
                else
                {
                    return Request.CreateResponse(HttpStatusCode.NotFound, erro.Descricao);
                }
            }
            catch (Exception exc)
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest, erro.Descricao);
            }
        }
    }
}
