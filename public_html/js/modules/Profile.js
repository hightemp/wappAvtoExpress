define(
  ['Vue', 'API'], 
  function(Vue, oAPI) 
  {
    return {
      namespaced: true,
      state: {
        iApplicationID: 0,
        oFields: {}
      },
      getters: {
        fnGetActiveFieldsValues(state)
        {
          console.log('getters - fnGetActiveFieldsValues', state['oFields']);
          var oResult = {};
          
          for (var sKey in state['oFields']) {
            if (!state['oFields'][sKey]['bDisabled']) {
              oResult[sKey] = {};
              oResult[sKey]['sField'] = state['oFields'][sKey]['sField'];
              oResult[sKey]['sValue'] = state['oFields'][sKey]['sValue'];
            }
          }
          
          return oResult;
        }
      },
      actions: {
        fnValidateField({ commit, state }, { oData, fnSuccess }) 
        {
          console.log('actions - fnValidateField', { oData, fnSuccess });
          oAPI.fnValidate(
            {
              sField: oData.sField,
              sValue: oData.sValue
            }, 
            fnSuccess
          );
        },
        fnUpdateField({ commit, state }, { oData }) 
        {
          console.log('actions - fnUpdateField', { oData });
          commit('UPDATE_FIELD', oData);
        },
        fnPostNano({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostNano');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Nano", fnSuccess);
        },
        fnPostShort({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostShort');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Short", fnSuccess);
        },
        fnPostFull({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostFull');
          oAPI.fnPost(this.getters.fnGetActiveFieldsValues, "Full", fnSuccess);
        },
        fnGetApplicationData({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnGetApplicationData');
          oAPI.fnGetApplicationData(
            state.iApplicationID,
            function(oData)
            {
              for (var sKey in oData['data']) {
                commit('UPDATE_FIELD', oData['data'][sKey]);
              }
              fnSuccess(oData);
            }
          );
        },
        fnSaveToStorage({ commit, state })
        {
          console.log('actions - fnSaveToStorage');
          localStorage.setItem('oState', JSON.stringify(state));
        },
        fnLoadFromStorage({ commit, state })
        {
          console.log('actions - fnLoadFromStorage');
          var oStorageState = JSON.parse(localStorage.getItem('oState'));
          for (var sKey in oStorageState) {
            commit('UPDATE_FIELD', oStorageState[sKey], sKey);
          }
        }
      },
      mutations: {
        UPDATE_FIELD(state, oData, sKey) 
        {
          console.log('mutations - UPDATE_FIELD', oData, sKey);
          if (sKey != undefined) {
            state['oFields'][sKey] = oData;
          } else {
            state['oFields'][oData.sField] = oData;
          }
        }
      }
    };
  }
);
