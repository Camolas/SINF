using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Net;
using System.Net.Http;
using System.Web.Http;
using FirstREST.Lib_Primavera.Model;
using System.Text.RegularExpressions;


namespace FirstREST.Controllers
{
    public class DocVendaController : ApiController
    {
        //
        // GET: /Clientes/

        public IEnumerable<Lib_Primavera.Model.DocVenda> Get()
        {
            return Lib_Primavera.PriIntegration.Encomendas_List();
        }


        // GET api/cliente/5    
        public dynamic/*Lib_Primavera.Model.DocVenda*/ Get(string id)
        {

            int numberCounter = Regex.Matches(id, @"[0-9]").Count;
            if (numberCounter == 0)
            {
                IEnumerable<Lib_Primavera.Model.DocVenda> encomendas = Lib_Primavera.PriIntegration.Encomendas_List(id);
                if (encomendas == null)
                {
                    throw new HttpResponseException(
                            Request.CreateResponse(HttpStatusCode.NotFound));

                }
                else
                {
                    return encomendas;
                }
            }
            else
            {
                IEnumerable<Lib_Primavera.Model.DocVenda> encomendas = Lib_Primavera.PriIntegration.Encomendas_List_Article(id);
                if (encomendas == null)
                {
                    throw new HttpResponseException(
                            Request.CreateResponse(HttpStatusCode.NotFound));

                }
                else
                {
                    return encomendas;
                }


            }


        }

        // GET api/cliente/5    
        public dynamic/*Lib_Primavera.Model.DocVenda*/ Get(string serie,string id)
        {

            Lib_Primavera.Model.DocVenda docvenda = Lib_Primavera.PriIntegration.Encomenda_Get(serie,id);
            if (docvenda == null)
                {
                    throw new HttpResponseException(
                            Request.CreateResponse(HttpStatusCode.NotFound));

                }
                else
                {
                    return docvenda;
                }

        }


        public HttpResponseMessage Post([FromBody]Lib_Primavera.Model.DocVenda dv)
        {
            System.Diagnostics.Debug.WriteLine(dv.Entidade);
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();
            erro = Lib_Primavera.PriIntegration.Encomendas_New(dv);
            
            if (erro.Erro == 0)
            {
                var response = Request.CreateResponse(
                   HttpStatusCode.Created, dv.id);
                string uri = Url.Link("DefaultApi", new {DocId = dv.id });
                response.Headers.Location = new Uri(uri);
                return response;
            }

            else
            {
                return Request.CreateResponse(HttpStatusCode.BadRequest);
            }

        }


        public HttpResponseMessage Put(string id, [FromBody]Lib_Primavera.Model.DocVenda dv)
        {

            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();

            try
            {
                erro = Lib_Primavera.PriIntegration.UpdOrder(id,dv);
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



        public HttpResponseMessage Delete(string id)
        {

            System.Diagnostics.Debug.WriteLine("Deleting");
            Lib_Primavera.Model.RespostaErro erro = new Lib_Primavera.Model.RespostaErro();

            try
            {

                erro = Lib_Primavera.PriIntegration.CancelOrder(id);

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
