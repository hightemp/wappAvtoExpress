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
        fnGetActiveFields(state)
        {
          console.log('getters - fnGetActiveFields');
          var oResult = {};
          
          for (var sKey in state) {
            if (!state['oFields'][sKey]['bDisabled']) {
              oResult[sKey] = state['oFields'][sKey];
            }
          }
          
          return oResult;
        }
      },
      actions: {
        fnValidateField({ commit, state }, { oData, fnSuccess }) 
        {
          console.log('actions - fnValidateField', { oData, fnSuccess });
          oAPI.fnValidate(oData, fnSuccess);
        },
        fnUpdateField({ commit, state }, { oData }) 
        {
          console.log('actions - fnUpdateField', { oData });
          commit('UPDATE_FIELD', oData);
        },
        fnPostNano({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostNano');
          oAPI.fnPost(this.getters.fnGetActiveFields, "Nano", fnSuccess);
        },
        fnPostShort({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostShort');
          oAPI.fnPost(this.getters.fnGetActiveFields, "Short", fnSuccess);
        },
        fnPostFull({ commit, state }, { fnSuccess }) 
        {
          console.log('actions - fnPostFull');
          oAPI.fnPost(this.getters.fnGetActiveFields, "Full", fnSuccess);
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
          if (sKey) {
            state['oFields'][sKey] = oData;
          } else {
            state['oFields'][oData.sField] = oData;
          }
        }
      }
    };
  }
);
